<?php

$GLOBALS['TL_HOOKS']['generatePage'][] = ['Anker\OpenGraphBundle\HookController', 'addHeadDataAction'];
