@extends('pages.layouts.layout')
@section('description') Admin Panel @endsection
@section('title') Admin - Panel @endsection
@section('header-text') Admin Panel @endsection
@section('content')
    <main class="holder" id="main-admin-panel">
        @csrf
        <div id="tables-wrapper">

            <div id="select-table-to-show">
                <select id="table-select">
                    <option value="default">Select table to show:</option>
                    <?php
                    $tables = [
                        ["Contact Messages", "ContactMessage"],
                        ["Footer Links", "FooterLink"],
                        ["Navigation Links", "NavMenuItem"],
                        ["Users", "User"],
                        ["User Roles", "UserRole"],
                        ["Destinations", "Destination"],
                        ["Destination Information", "DestinationInformation"],
                        ["Activities", "Activity"],
                        ["Activity Images", "ActivityImage"],
                        ["Hotels", "Hotel"],
                        ["Travel Dates", "TravelDate"],
                        ["Bus Fare", "TravelPrice"]
                    ];

                    foreach($tables as $table):
                    ?>
                    <option value="<?= $table[1]?>"><?= ucfirst($table[0])?></option>
                    <?php endforeach ?>
                </select>
                <div id="admin-search">
                    <select id="select-search">

                    </select>
                    <input id="search-term" name="search-term" type="text" placeholder="Search term"/>
                    <input id="search-button" name="search-button" type="button" value="Search"/>
                    <input id="search-reset" name="search-reset" type="button" value="Reset"/>
                    <span id="invalid-search-term">

                    </span>
                </div>
            </div>

            <div id="table-information-wrapper">
            </div>

        </div>
    </main>
@endsection
