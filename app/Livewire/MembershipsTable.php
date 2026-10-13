<?php

namespace App\Livewire;

use App\Http\Controllers\MembershipController;
use App\Models\Membership;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
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
                TextColumn::make('membership_type')->label('Membership type'),
                TextColumn::make('join_date')->label('Join date')->date('Y-m-d'),
                TextColumn::make('expiry_date')->label('Expiry date')->date('Y-m-d'),
                TextColumn::make('processed_at')
                    ->label('Membership processed at')
                    ->dateTime('d/m/Y H:i', 'Europe/Dublin')
                    ->placeholder('—'),
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

    public function render()
    {
        return view('livewire.memberships-table');
    }
}
