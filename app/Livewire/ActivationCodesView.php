<?php

namespace App\Livewire;

use App\Models\ActivationCodes;
use App\Models\Member;
use App\Models\User;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ActivationCodesView extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;



    public function table(Table $table): Table
    {
        return $table
            ->query(ActivationCodes::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('code')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')->searchable()->sortable()->toggleable(),
                TextColumn::make('member_full_name')
                    ->getStateUsing(function ($record) {
                        // 1. Fetch the related member using the license code from the current row
                        $member = Member::where('number', $record->licence)->first();

                        // 2. Combine the names if the member exists
                        if ($member) {
                            return "{$member->first_name} {$member->last_name}";
                        }

                        return 'Unknown Member';
                    })
                ->label('Member Name'),
                TextColumn::make('licence')->searchable()
                ->label('Licence Number'),
                TextColumn::make('created_at')->dateTime()->sortable(),
                TextColumn::make('expires_at')
                    ->dateTime()
                    ->since()
                    ->dateTimeTooltip()
                    ->sortable()
                    ->label('Code expiry'),
            ])
            ->actions([
                DeleteAction::make(),
            ]);
    }

    public function render()
    {
        FilamentColor::register([
            'danger' => Color::Red,
        ]);

        return view('livewire.activation-codes-view');
    }
}
