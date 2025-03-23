<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\Member;

class MembersTableFilament extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $searchQuery;

    public function mount() {
        $searchQuery = '';
//        $this->members = Member::simplePaginate(50);
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Member::query())
            ->columns([
                TextColumn::make('index')
                    ->rowIndex()
                    ->label('#'),
                TextColumn::make('number')->searchable()
                    ->sortable()
                    ->label('Memb. No.'),
                TextColumn::make('last_name')->searchable()->sortable(),
                TextColumn::make('first_name'),
                TextColumn::make('dob')->date('Y-m-d')->searchable()->label('Date of Birth')
                    ->sortable(),
                TextColumn::make('active')
                    ->badge()
                    ->color(fn($active) => match($active) {
                        'false' => 'danger',
                        'true' => 'success',
                    }

                    )
                    ->label('Membership'),
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }

    public function updatingSearchquery()
    {
//        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.members-table');
    }
}
