<?php

declare (strict_types = 1);

/**
 * This file is part of CodeIgniter Shield.
 *
 * (c) CodeIgniter Foundation <admin@codeigniter.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace Config;

use CodeIgniter\Shield\Config\AuthGroups as ShieldAuthGroups;

class AuthGroups extends ShieldAuthGroups
{
    /**
     * --------------------------------------------------------------------
     * Default Group
     * --------------------------------------------------------------------
     * The group that a newly registered user is added to.
     */
    public string $defaultGroup = 'user';

    /**
     * --------------------------------------------------------------------
     * Groups
     * --------------------------------------------------------------------
     * An associative array of the available groups in the system, where the keys
     * are the group names and the values are arrays of the group info.
     *
     * Whatever value you assign as the key will be used to refer to the group
     * when using functions such as:
     *      $user->addGroup('superadmin');
     *
     * @var array<string, array<string, string>>
     *
     * @see https://codeigniter4.github.io/shield/quick_start_guide/using_authorization/#change-available-groups for more info
     */
    public array $groups = [
        'superadmin' => [
            'title'       => 'Super Admin',
            'description' => 'Complete control of the site.',
        ],
        'admin'      => [
            'title'       => 'Admin',
            'description' => 'Day to day administrators of the site.',
        ],
        'user'       => [
            'title'       => 'User',
            'description' => 'General users of the site. Often customers.',
        ],
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions
     * --------------------------------------------------------------------
     * The available permissions in the system.
     *
     * If a permission is not listed here it cannot be used.
     */
    public array $permissions = [
        'admin.access'          => 'Can access the sites admin area',
        'admin.settings'        => 'Can access the main site settings',
        'users.manage-admins'   => 'Can manage other admins',
        'users.create'          => 'Can create new non-admin users',
        'users.edit'            => 'Can edit existing non-admin users',
        'users.delete'          => 'Can delete existing non-admin users',

        //Part-I Data
        'partone.list'          => 'Can list all FCPS Part-I candidates',

        //Training permissions
        'training.trainee.list' => 'Can list all trainees',
        'training.basic.get'    => 'Can access the basic info of trainee',
        'training.basic.edit'   => 'Can edit basic information',
        'training.create'       => 'Can create training data',
        'training.edit'         => 'Can edit training data',
        'training.delete'       => 'Can delete training data',
    ];

    /**
     * --------------------------------------------------------------------
     * Permissions Matrix
     * --------------------------------------------------------------------
     * Maps permissions to groups.
     *
     * This defines group-level permissions.
     */
    public array $matrix = [
        'superadmin' => [
            'admin.*',
            'users.*',
            'training.*',
        ],
        'admin'      => [
            'admin.access',
            'users.create',
            'users.edit',
            'users.delete',
            'partone.list',
        ],
        'user'       => [
            'training.basic.get',
        ],
    ];
}
