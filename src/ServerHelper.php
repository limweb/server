<?php
/**
 * Created by PhpStorm.
 * User: inhere
 * Date: 2017-02-20
 * Time: 15:11
 */

namespace inhere\server;

use inhere\librarys\helpers\PhpHelper;

/**
 * Class ServerHelper
 * @package inhere\server
 */
class ServerHelper
{
    /**
     *
     */
    public static function checkRuntimeEnv()
    {
        if ( !PhpHelper::isCli() ) {
            throw new \RuntimeException('Server must run in the CLI mode.');
        }

        if ( !PhpHelper::extIsLoaded('swoole', false) ) {
            throw new \RuntimeException('Run the server, extension \'swoole\' is required!');
        }
    }

    /**
     * get Pid By PidFile
     * @return int
     */
    public static function getPidByPidFile($pidFile)
    {
        if ($pidFile && file_exists($pidFile)) {
            $pid = (int)file_get_contents($pidFile);

            if (posix_getpgid($pid)) {
                return $pid;
            } else {
                unlink($pidFile);
            }
        }

        return 0;
    }

//////////////////////////////////////////////////////////////////////
/// some help method(from workman)
//////////////////////////////////////////////////////////////////////

    /**
     * Get unix user of current process.
     *
     * @return string
     */
    public static function getCurrentUser()
    {
        $userInfo = posix_getpwuid(posix_getuid());

        return $userInfo['name'];
    }

    /**
     * Set unix user and group for current process.
     * @return true|string
     */
    public static function setUserAndGroup($user, $group = '')
    {
        // Get uid.
        if (!$userInfo = posix_getpwnam($user)) {
            return "Warning: User {$user} not exists";
        }

        $uid = $userInfo['uid'];

        // Get gid.
        if ($group) {

            if (!$groupInfo = posix_getgrnam($group)) {
                return "Warning: Group {$group} not exists";
            }

            $gid = $groupInfo['gid'];
        } else {
            $gid = $userInfo['gid'];
        }

        if ( !posix_initgroups($userInfo['name'], $gid) ) {
            return "Warning: The user [{$user}] is not in the user group ID [GID:{$gid}].";
        }

        // Set uid and gid.
        // if ($uid != posix_getuid() || $gid != posix_getgid()) {
            if (!posix_setgid($gid) || !posix_setuid($uid)) {
                return "Warning: change gid or uid fail.";
            }
        // }

        return true;
    }

    /**
     * Set process title.
     * @param string $title
     * @return void
     */
    public static function setProcessTitle($title)
    {
        // >=php 5.5
        if (function_exists('cli_set_process_title') && !PhpHelper::isMac()) {
            cli_set_process_title($title);

            // Need process title when php<=5.5
        } else {
            swoole_set_process_name($title);
        }
    }
}
