<?php

declare(strict_types=1);

namespace Stu\Control;

use Tuple;

interface GameControllerInterface
{
    public function getGameState();

    public function setTemplateFile($tpl);

    public function showAjaxMacro($macro);

    public function getAjaxMacro();

    public function getMemoryUsage();

    function getInformation();

    public function hasInformation();

    public function setTemplateVar(string $key, $variable);

    public function getUser();

    public function getBenchmark();

    public function getPlayerCount();

    public function getOnlinePlayerCount();

    public function getUserName();

    public function getGameConfig();

    public function getGameConfigValue($value);

    public function getUniqHandle();

    function addNavigationPart(Tuple $part);

    public function appendNavigationPart(string $url, string $title);

    public function getNavigation();

    public function getPageTitle();

    public function setPageTitle($title);

    public function getQueryCount();

    public function getDebugNotices();

    public function hasExecuteJS();

    public function getExecuteJS();

    public function getGameVersion();

    public function getFriendsOnline();

    public function getFriendsOnlineCount();

    public function getCurrentRound();

    public function getNewPMNavlet();

    public function isDebugMode();

    public function getJavascriptPath();

    public function getPlanetColonyLimit();

    public function getMoonColonyLimit();

    public function getPlanetColonyCount();

    public function getMoonColonyCount();

    public function isAdmin();

    public function getRecentHistory();

    public function getAchievements();

    public function getSessionString(): string;

    public function main(bool $session_check = true): void;
}