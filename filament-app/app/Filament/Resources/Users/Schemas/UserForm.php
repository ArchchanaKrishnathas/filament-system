<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Basic")
                    ->schema([
                        TextInput::make("name")->required(),
                        TextInput::make("email"),
                        TextInput::make("password")->password()
                    ]),

                Section::make("Location")
                    ->schema([
                        Select::make("country_id")
                            ->label("Country")
                            ->options(Country::pluck("name","id"))
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set){
                                $set("state_id",null);
                                $set("city_id",null);
                            }),
                        Select::make("state_id")
                                ->label("State")
                                ->options(function (callable $get){
                                    $country = $get("country_id");

                                    if(!$country){
                                        return [];
                                    } else {
                                        return State::whereCountryId($country)
                                            ->pluck("name","id");
                                    }
                                    })
                                            ->reactive()
                                            ->afterStateUpdated(function ($state, callable $set){
                                                   $set("city_id",null);
                                            }),
                        Select::make("city_id")
                                ->label("City")
                                ->options(function (callable $get){
                                    $state = $get("state_id");

                                    if(!$state){
                                        return [];
                                    } else {
                                        return City::whereStateId($state)
                                            ->pluck("name","id");
                                    }
                                    })
                                            ->reactive()

                    ])
                ]);
    }
}
