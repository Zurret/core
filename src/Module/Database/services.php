<?php

declare(strict_types=1);

namespace Stu\Module\Database;

use Stu\Control\GameController;
use Stu\Control\IntermediateController;
use Stu\Lib\SessionInterface;
use Stu\Module\Database\View\Category\CategoryRequest;
use Stu\Module\Database\View\Category\CategoryRequestInterface;
use Stu\Module\Database\View\Category\Tal\DatabaseCategoryTalFactory;
use Stu\Module\Database\View\Category\Tal\DatabaseCategoryTalFactoryInterface;
use Stu\Module\Database\View\UserList\UserListRequest;
use Stu\Module\Database\View\UserList\UserListRequestInterface;
use Stu\Module\Database\View\DatabaseEntry\DatabaseEntryRequest;
use Stu\Module\Database\View\DatabaseEntry\DatabaseEntryRequestInterface;
use Stu\Module\Database\View\DatabaseEntry\DatabaseEntry;
use Stu\Module\Database\View\Category\Category;
use Stu\Module\Database\View\DiscovererRating\DiscovererRanking;
use Stu\Module\Database\View\UserList\UserList;
use Stu\Module\Database\View\Overview\Overview;
use function DI\autowire;
use function DI\create;
use function DI\get;

return [
    DatabaseCategoryTalFactoryInterface::class => autowire(DatabaseCategoryTalFactory::class),
    DatabaseEntryRequestInterface::class => autowire(DatabaseEntryRequest::class),
    CategoryRequestInterface::class => autowire(CategoryRequest::class),
    UserListRequestInterface::class => autowire(UserListRequest::class),
    IntermediateController::TYPE_DATABASE => create(IntermediateController::class)
        ->constructor(
            get(SessionInterface::class),
            [],
            [
                Category::VIEW_IDENTIFIER => autowire(Category::class),
                DiscovererRanking::VIEW_IDENTIFIER => autowire(DiscovererRanking::class),
                UserList::VIEW_IDENTIFIER => autowire(UserList::class),
                DatabaseEntry::VIEW_IDENTIFIER => autowire(DatabaseEntry::class),
                GameController::DEFAULT_VIEW => autowire(Overview::class),
            ]
        ),
];