<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    use RefreshDatabase; // Đảm bảo cơ sở dữ liệu được làm mới sau mỗi bài kiểm thử

    /**
     * Test tạo sản phẩm mới
     *
     * @return void
     */
    public function test_create_product()
    {
        // Tạo dữ liệu mẫu để gửi yêu cầu POST
        $response = $this->post('/products', [
            'Pro_name' => 'Product 1',
            'price' => 100,
            'stock' => 50,
            'cate_id' => 1,
        ]);

        // Kiểm tra mã trạng thái HTTP (201: Created)
        $response->assertStatus(201);

        // Kiểm tra trong cơ sở dữ liệu có sản phẩm vừa tạo
        $this->assertDatabaseHas('products', [
            'Pro_name' => 'Product 1',
            'price' => 100,
        ]);
    }
    public function test_read_product()
{
    $product = Product::factory()->create(); // Tạo sản phẩm giả

    $response = $this->get('/products/'.$product->id);
    $response->assertStatus(200);
    $response->assertSee($product->Pro_name);
}
public function test_update_product()
{
    $product = Product::factory()->create(); // Tạo sản phẩm giả

    $response = $this->put('/products/'.$product->id, [
        'Pro_name' => 'Updated Product',
        'price' => 150,
    ]);

    $response->assertStatus(200);
    $this->assertDatabaseHas('products', [
        'Pro_name' => 'Updated Product',
        'price' => 150,
    ]);
}
public function test_delete_product()
{
    $product = Product::factory()->create(); // Tạo sản phẩm giả

    $response = $this->delete('/products/'.$product->id);

    $response->assertStatus(200);
    $this->assertDatabaseMissing('products', [
        'Pro_name' => $product->Pro_name,
    ]); // Kiểm tra cơ sở dữ liệu không còn sản phẩm nữa
}
public function test_require_login_for_create_product()
{
    $response = $this->post('/products', [
        'Pro_name' => 'Product 1',
        'price' => 100,
        'stock' => 50,
        'cate_id' => 1,
    ]);

    $response->assertRedirect('/login'); // Kiểm tra yêu cầu đăng nhập
}
public function test_admin_can_create_product()
{
    $user = User::factory()->create(['role' => 'admin']);
    $this->actingAs($user);

    $response = $this->post('/products', [
        'Pro_name' => 'Product 1',
        'price' => 100,
        'stock' => 50,
        'cate_id' => 1,
    ]);

    $response->assertStatus(201); // Admin có quyền tạo sản phẩm
}

public function test_non_admin_cannot_create_product()
{
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user);

    $response = $this->post('/products', [
        'Pro_name' => 'Product 1',
        'price' => 100,
        'stock' => 50,
        'cate_id' => 1,
    ]);

    $response->assertStatus(403); // Người dùng không phải admin bị từ chối quyền
}
public function test_no_xss_in_product_name()
{
    $response = $this->post('/products', [
        'Pro_name' => '<script>alert("XSS")</script>',
        'price' => 100,
        'stock' => 50,
        'cate_id' => 1,
    ]);

    $response->assertStatus(201);
    $this->assertDatabaseHas('products', [
        'Pro_name' => '&lt;script&gt;alert(&quot;XSS&quot;)&lt;/script&gt;', // Kiểm tra chuỗi XSS được mã hóa
    ]);
}
public function test_user_registration()
{
    $response = $this->post('/register', [
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response->assertStatus(201); // Kiểm tra trạng thái thành công
    $this->assertDatabaseHas('users', [
        'email' => 'johndoe@example.com',
    ]);
}
public function test_user_login()
{
    $user = User::factory()->create([
        'email' => 'johndoe@example.com',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post('/login', [
        'email' => 'johndoe@example.com',
        'password' => 'password',
    ]);

    $response->assertStatus(200); // Kiểm tra đăng nhập thành công
}

}
