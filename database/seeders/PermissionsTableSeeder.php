<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'auth_profile_edit',
            ],
            [
                'id'    => 2,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 3,
                'title' => 'permission_create',
            ],
            [
                'id'    => 4,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 5,
                'title' => 'permission_show',
            ],
            [
                'id'    => 6,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 7,
                'title' => 'permission_access',
            ],
            [
                'id'    => 8,
                'title' => 'role_create',
            ],
            [
                'id'    => 9,
                'title' => 'role_edit',
            ],
            [
                'id'    => 10,
                'title' => 'role_show',
            ],
            [
                'id'    => 11,
                'title' => 'role_delete',
            ],
            [
                'id'    => 12,
                'title' => 'role_access',
            ],
            [
                'id'    => 13,
                'title' => 'user_create',
            ],
            [
                'id'    => 14,
                'title' => 'user_edit',
            ],
            [
                'id'    => 15,
                'title' => 'user_show',
            ],
            [
                'id'    => 16,
                'title' => 'user_delete',
            ],
            [
                'id'    => 17,
                'title' => 'user_access',
            ],
            [
                'id'    => 18,
                'title' => 'event_create',
            ],
            [
                'id'    => 19,
                'title' => 'event_edit',
            ],
            [
                'id'    => 20,
                'title' => 'event_show',
            ],
            [
                'id'    => 21,
                'title' => 'event_delete',
            ],
            [
                'id'    => 22,
                'title' => 'event_access',
            ],
            [
                'id'    => 23,
                'title' => 'event_management_access',
            ],
            [
                'id'    => 24,
                'title' => 'ensemble_create',
            ],
            [
                'id'    => 25,
                'title' => 'ensemble_edit',
            ],
            [
                'id'    => 26,
                'title' => 'ensemble_show',
            ],
            [
                'id'    => 27,
                'title' => 'ensemble_delete',
            ],
            [
                'id'    => 28,
                'title' => 'ensemble_access',
            ],
            [
                'id'    => 29,
                'title' => 'conductor_create',
            ],
            [
                'id'    => 30,
                'title' => 'conductor_edit',
            ],
            [
                'id'    => 31,
                'title' => 'conductor_show',
            ],
            [
                'id'    => 32,
                'title' => 'conductor_delete',
            ],
            [
                'id'    => 33,
                'title' => 'conductor_access',
            ],
            [
                'id'    => 34,
                'title' => 'composition_management_access',
            ],
            [
                'id'    => 35,
                'title' => 'composition_create',
            ],
            [
                'id'    => 36,
                'title' => 'composition_edit',
            ],
            [
                'id'    => 37,
                'title' => 'composition_show',
            ],
            [
                'id'    => 38,
                'title' => 'composition_delete',
            ],
            [
                'id'    => 39,
                'title' => 'composition_access',
            ],
            [
                'id'    => 40,
                'title' => 'artist_create',
            ],
            [
                'id'    => 41,
                'title' => 'artist_edit',
            ],
            [
                'id'    => 42,
                'title' => 'artist_show',
            ],
            [
                'id'    => 43,
                'title' => 'artist_delete',
            ],
            [
                'id'    => 44,
                'title' => 'artist_access',
            ],
            [
                'id'    => 45,
                'title' => 'artisttype_create',
            ],
            [
                'id'    => 46,
                'title' => 'artisttype_edit',
            ],
            [
                'id'    => 47,
                'title' => 'artisttype_show',
            ],
            [
                'id'    => 48,
                'title' => 'artisttype_delete',
            ],
            [
                'id'    => 49,
                'title' => 'artisttype_access',
            ],
            [
                'id'    => 50,
                'title' => 'participant_management_access',
            ],
            [
                'id'    => 51,
                'title' => 'school_create',
            ],
            [
                'id'    => 52,
                'title' => 'school_edit',
            ],
            [
                'id'    => 53,
                'title' => 'school_show',
            ],
            [
                'id'    => 54,
                'title' => 'school_delete',
            ],
            [
                'id'    => 55,
                'title' => 'school_access',
            ],
            [
                'id'    => 56,
                'title' => 'instrumentation_create',
            ],
            [
                'id'    => 57,
                'title' => 'instrumentation_edit',
            ],
            [
                'id'    => 58,
                'title' => 'instrumentation_show',
            ],
            [
                'id'    => 59,
                'title' => 'instrumentation_delete',
            ],
            [
                'id'    => 60,
                'title' => 'instrumentation_access',
            ],
            [
                'id'    => 61,
                'title' => 'participant_create',
            ],
            [
                'id'    => 62,
                'title' => 'participant_edit',
            ],
            [
                'id'    => 63,
                'title' => 'participant_show',
            ],
            [
                'id'    => 64,
                'title' => 'participant_delete',
            ],
            [
                'id'    => 65,
                'title' => 'participant_access',
            ],
            [
                'id'    => 66,
                'title' => 'program_create',
            ],
            [
                'id'    => 67,
                'title' => 'program_edit',
            ],
            [
                'id'    => 68,
                'title' => 'program_show',
            ],
            [
                'id'    => 69,
                'title' => 'program_delete',
            ],
            [
                'id'    => 70,
                'title' => 'program_access',
            ],
            [
                'id'    => 71,
                'title' => 'programlist_create',
            ],
            [
                'id'    => 72,
                'title' => 'programlist_edit',
            ],
            [
                'id'    => 73,
                'title' => 'programlist_show',
            ],
            [
                'id'    => 74,
                'title' => 'programlist_delete',
            ],
            [
                'id'    => 75,
                'title' => 'programlist_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
