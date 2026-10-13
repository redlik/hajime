<?php

namespace App\Livewire;

use App\Http\Controllers\MembershipController;
use App\Models\Membership;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Carbon\Carbon;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MembershipsTable extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $member_id;

    public function mount($member_id)
    {
        $this->member_id = $member_id;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Membership::query()->where('member_id', $this->member_id))
            ->defaultSort('expiry_date', 'desc')
            ->paginated(false)
            ->emptyStateHeading('No membership registered for this member yet.')
            ->columns([
                TextColumn::make('membership_type')->label('Membership type')->sortable(),
                TextColumn::make('join_date')->label('Join date')->date('Y-m-d')->sortable(),
                TextColumn::make('expiry_date')->label('Expiry date')->date('Y-m-d')->sortable(),
                $this->processedAtColumn(),
            ])
            ->actions([
                Action::make('delete')
                    ->label('')
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Delete membership')
                    ->modalDescription('Do you want to delete the record completely?')
                    // Reuse the controller so the active flag and activity log stay in one place.
                    ->action(fn (Membership $record) => app(MembershipController::class)->destroy(request(), $record)),
            ]);
    }

    private const TIMEZONE = 'Europe/Dublin';

    private function isAdmin(): bool
    {
        return (bool) Auth::user()?->hasRole('admin');
    }

    /**
     * Read-only for everyone, except admins may fill in a blank value once
     * (e.g. memberships processed before the column existed).
     */
    private function processedAtColumn(): Column
    {
        if (! $this->isAdmin()) {
            return TextColumn::make('processed_at')
                ->label('Membership processed at')
                ->dateTime('d/m/Y H:i', self::TIMEZONE)
                ->placeholder('—')
                ->sortable();
        }

        return TextInputColumn::make('processed_at')
            ->label('Membership processed at')
            ->type('datetime-local')
            ->sortable()
            ->getStateUsing(fn (Membership $record) => $record->processed_at
                ?->timezone(self::TIMEZONE)->format('Y-m-d\TH:i'))
            ->disabled(fn (Membership $record) => filled($record->processed_at))
            ->updateStateUsing(function (Membership $record, $state) {
                // Re-check on the server: the disabled flag alone can be bypassed.
                $record->refresh();
                if (! $this->isAdmin() || $record->processed_at !== null || blank($state)) {
                    return;
                }

                $record->processed_at = Carbon::parse($state, self::TIMEZONE)->utc();
                $record->save();

                activity()
                    ->performedOn($record->member)
                    ->causedBy(Auth::id())
                    ->withProperty('membership_id', $record->id)
                    ->withProperty('processed_at', $record->processed_at->toDateTimeString())
                    ->log('Membership processed-at date filled in manually');
            });
    }

    public function render()
    {
        return view('livewire.memberships-table');
    }
}
