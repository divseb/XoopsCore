<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * XOOPS image access
 *
 * @copyright       XOOPS Project (http://xoops.org)
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         core
 * @since           2.6.0
 * @version         $Id$
 */

include __DIR__ . '/mainfile.php';

XoopsPreload::getInstance()->triggerEvent('core.image');

header('Content-type: image/gif');
readfile(\XoopsBaseConfig::get('uploads-path') . '/blank.gif');
