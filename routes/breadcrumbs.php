<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use App\Models\Auction;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > Auctions
Breadcrumbs::for('auctions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Auctions', route('auctions.index'));
});

//Home > Search
Breadcrumbs::for('search', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Search', route('home'));
});

// Home > Auctions > [title]
Breadcrumbs::for('auction', function (BreadcrumbTrail $trail, Auction $auction) {
    $trail->parent('auctions');
    $trail->push($auction->title, route('auctions.show', $auction));
});
