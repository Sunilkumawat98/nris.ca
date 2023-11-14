<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PermissionRole;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $insertsData = [
            ['role_id' => 1, 'permission_id'=>1, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>2, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>3, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>4, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>5, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>6, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>7, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>8, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>9, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>10, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>11, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>12, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>13, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>14, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>15, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>16, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>17, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>18, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>19, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>20, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>21, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>22, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>23, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>24, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>25, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>26, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>27, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>28, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>29, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>30, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>31, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>32, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>33, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>34, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>35, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>36, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>37, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>38, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>39, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>40, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>41, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>42, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>43, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>44, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>45, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>46, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>47, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>48, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>48, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>50, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>51, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>52, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>53, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>54, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>55, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>56, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>57, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>58, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>59, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>60, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>61, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>62, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>63, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>64, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>65, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>66, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>67, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>68, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>69, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>70, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>71, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>72, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>73, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>74, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>75, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>76, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>77, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>78, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>79, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>80, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>81, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>82, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>83, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>84, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>85, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>86, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>87, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>88, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>89, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>90, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>91, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>92, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>93, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>94, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>95, 'is_active' => 1],

            ['role_id' => 1, 'permission_id'=>96, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>97, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>98, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>99, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>100, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>101, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>102, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>103, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>104, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>105, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>106, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>107, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>108, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>109, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>110, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>111, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>112, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>113, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>114, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>115, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>116, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>117, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>118, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>119, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>120, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>121, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>122, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>123, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>124, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>125, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>126, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>127, 'is_active' => 1],

            ['role_id' => 1, 'permission_id'=>128, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>129, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>130, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>131, 'is_active' => 1],
            ['role_id' => 1, 'permission_id'=>132, 'is_active' => 1],
            
            


            // Add more user data entries as needed
        ];
       

        foreach ($insertsData as $insertData) {
            $existingData = PermissionRole::where('role_id', $insertData['role_id'])
                                            ->where('permission_id', $insertData['permission_id'])
                                                    ->first();
            if (!$existingData) {
                PermissionRole::create($insertData);
                $this->command->info("PermissionRole '{$insertData['role_id']}' and '{$insertData['permission_id']}' inserted successfully.");
            } else {
                $this->command->info("PermissionRole '{$insertData['role_id']}' and '{$insertData['permission_id']}' already exists. Skipping insertion.");
            }
        }
    }
}
