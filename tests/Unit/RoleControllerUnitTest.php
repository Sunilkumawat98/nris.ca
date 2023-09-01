<?php
namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\Admin\RoleController;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker; // Add WithFaker trait
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Factories; // Remove this line
use Database\Factories\RoleFactory;
use Mockery;
use Illuminate\Support\Facades\Auth; // Import Auth facade
use Illuminate\Pagination\LengthAwarePaginator; // Import the paginator class
use Illuminate\Support\Facades\DB;

class RoleControllerUnitTest extends TestCase
{
    use WithFaker; // Add RefreshDatabase and WithFaker traits
    


    public function testIndexMethod()
    {
        // Create a mock user with mock permissions
        $user = Mockery::mock(User::class);
        $user->shouldReceive('hasPermission')->with('manage_roles')->andReturn(true);
        Auth::shouldReceive('user')->andReturn($user);

        // Create mock roles
        $roles = Role::factory()->count(10)->make();

        // Create a mock paginator with roles
        $perPage = 10;
        $currentPage = 1;
        $total = count($roles);
        $paginator = new LengthAwarePaginator($roles, $total, $perPage, $currentPage);

        // Mock the Eloquent query to return roles
        DB::shouldReceive('table')->with('roles')->andReturnSelf();
        DB::shouldReceive('where')->with('status', 1)->andReturnSelf();
        DB::shouldReceive('orderBy')->with('id', 'DESC')->andReturnSelf();
        DB::shouldReceive('paginate')->with(10)->andReturn($paginator);

        $controller = new RoleController();
        $request = new Request();

        $response = $controller->index($request);

        // Assertions
        $this->assertEquals('admin.role.index', $response->getName());
    }


    public function testRoleCreate()
    {
        $this->withoutMiddleware(); // Disable middleware for this test
        $this->withoutExceptionHandling(); // Optional: Disable exception handling to see detailed errors

        // Create a mock user with mock permissions
        $user = Mockery::mock(User::class);
        $user->shouldReceive('hasPermission')->andReturn(true);
        $this->be($user); // Authenticate the mock user

        // Generate fake data for a new role
        $name = ucfirst($this->faker->word);
        $nameSlug = Str::slug($name);
        $data = [
            '_token'=>csrf_token(),
            'name' => $name,
            'name_slug' => $nameSlug,
            'is_active' => 0,
        ];

        $controller = new RoleController();
        
        // Create the request with the CSRF token from the session
        $request = Request::create('/role', 'POST', $data);
        // $request->headers->set('_token', csrf_token());

        $response = $controller->store($request);

        // Check the response
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        $this->assertDatabaseHas('roles', [
            'name' => $name,
            'name_slug' => $nameSlug,
            'is_active' => 0,
        ]); // Ensure the role is in the database
    }




    public function testEditMethod()
    {
        // Create a mock user with mock permissions
        $user = Mockery::mock(User::class);
        $user->shouldReceive('hasPermission')->with('edit_roles')->andReturn(true);
        $this->actingAs($user);

        // Create a mock role
        $role = Role::factory()->create();

        $controller = new RoleController();

        $response = $controller->edit($role->id);

        // Assertions
        $this->assertEquals('admin.role.edit', $response->getName());
        $this->assertArrayHasKey('results', $response->getData());
    }

    public function testUpdateMethod()
    {
        // Create a mock user with mock permissions
        $user = Mockery::mock(User::class);
        $user->shouldReceive('hasPermission')->with('edit_roles')->andReturn(true);
        $this->actingAs($user);

        // Create a mock role
        $role = Role::factory()->create();

        // Mock request data
        $name = ucfirst($this->faker->word);
        $nameSlug = Str::slug($name);
        $requestData = [
            'name' => $name,
            'name_slug' => $nameSlug,
            'is_active' => 0,
        ];

        // Mock request object
        $request = new Request($requestData);

        $controller = new RoleController();

        // Call the update method
        $response = $controller->update($request, $role->id);

        // Assertions
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());
        $this->assertDatabaseHas('roles', [
            'id' => $role->id,
            'name' => ucfirst($requestData['name']),
            'name_slug' => Str::slug($requestData['name']),
        ]);


    }




    public function testRoleCanBeDeleted()
    {
        $this->withoutMiddleware();
        
        // Create a mock user with mock permissions
        $user = Mockery::mock(User::class);
        $user->shouldReceive('hasPermission')->with('delete_roles')->andReturn(true);
        $this->actingAs($user);
        
        $role = Role::factory()->create();

        // Create an instance of the controller
        $controller = new RoleController();

        // Call the destroy method
        $response = $controller->destroy($role);

        // Assertions
        $this->assertEquals(Response::HTTP_FOUND, $response->getStatusCode());

        // $response->assertRedirect(route('role.index')); // Make sure 'role.index' matches your route name
        $this->assertSoftDeleted('roles', ['id' => $role->id]);
    }

    public function testLiveStatusCanBeToggled()
    {
        $this->withoutMiddleware(); // Disable middleware for this test
        $this->actingAs(User::factory()->create());

        $role = Role::factory()->create();

        $initialStatus = $role->is_active;
        $expectedStatus = ($initialStatus === 1) ? 0 : 1;

        $response = $this->post(route('role.activeStatus', $role));

        $response->assertRedirect(route('role.index'));
        $this->assertEquals($expectedStatus, $role->fresh()->is_active);
    }



}
