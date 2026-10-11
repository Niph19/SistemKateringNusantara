<?php

use App\Models\Category;
use App\Models\City;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

function makeAdminCrudOrder(): Order
{
    return Order::factory()->create([
        'customer_id' => Customer::factory()->create()->id,
        'payment_method_id' => PaymentMethod::factory()->create()->id,
        'courier_id' => Courier::factory()->create()->id,
    ]);
}

it('restricts dashboard and management pages to authenticated admins', function () {
    $this->get(route('admin.index'))->assertRedirect(route('login'));

    $this->actingAs(User::factory()->create())
        ->get(route('admin.index'))
        ->assertForbidden();

    $this->get(route('dashboard'))->assertForbidden();
});

it('redirects the home page to a destination available to the signed-in role', function () {
    $this->get(route('home'))->assertRedirect(route('login'));

    $this->actingAs(User::factory()->create())
        ->get(route('home'))
        ->assertRedirect(route('profile.edit'));

    $this->actingAs(User::factory()->admin()->create())
        ->get(route('home'))
        ->assertRedirect(route('dashboard'));
});

it('allows admins to open all resource lists and forms', function () {
    $this->actingAs(User::factory()->admin()->create());

    foreach ([
        'cities',
        'categories',
        'payment-methods',
        'couriers',
        'customers',
        'menus',
        'orders',
        'order-items',
    ] as $resource) {
        $this->get(route("admin.{$resource}.index"))->assertOk();
        $this->get(route("admin.{$resource}.create"))->assertOk();
    }
});

it('creates searches updates and deletes cities while paginating the list', function () {
    $this->actingAs(User::factory()->admin()->create());

    $this->post(route('admin.cities.store'), ['name' => 'Bandung'])
        ->assertRedirect(route('admin.cities.index'));
    $city = City::query()->where('name', 'Bandung')->firstOrFail();

    $this->get(route('admin.cities.index', ['search' => 'Bandung']))
        ->assertOk()
        ->assertSee('Bandung');

    $this->put(route('admin.cities.update', $city), ['name' => 'Bogor'])
        ->assertRedirect(route('admin.cities.index'));
    expect($city->fresh()->name)->toBe('Bogor');

    $this->delete(route('admin.cities.destroy', $city))
        ->assertRedirect(route('admin.cities.index'));
    expect(City::query()->whereKey($city->id)->exists())->toBeFalse();

    City::factory(16)->create();
    $this->get(route('admin.cities.index'))
        ->assertOk()
        ->assertSee('page=2')
        ->assertSeeText('Menampilkan')
        ->assertSeeText('1–15');
});

it('creates searches updates and protects categories that have menus', function () {
    $this->actingAs(User::factory()->admin()->create());

    $this->post(route('admin.categories.store'), ['name' => 'Makanan Utama'])
        ->assertRedirect(route('admin.categories.index'));
    $category = Category::query()->where('name', 'Makanan Utama')->firstOrFail();

    $this->put(route('admin.categories.update', $category), ['name' => 'Hidangan Utama'])
        ->assertRedirect(route('admin.categories.index'));
    expect($category->fresh()->name)->toBe('Hidangan Utama');

    Menu::factory()->create(['category_id' => $category->id]);
    $this->delete(route('admin.categories.destroy', $category))
        ->assertRedirect()
        ->assertSessionHas('error');
    expect($category->fresh())->not->toBeNull();

    $unusedCategory = Category::factory()->create(['name' => 'Kategori kosong']);
    $this->get(route('admin.categories.index', ['search' => 'Kategori kosong']))
        ->assertOk()
        ->assertSee('Kategori kosong');
    $this->delete(route('admin.categories.destroy', $unusedCategory))
        ->assertRedirect(route('admin.categories.index'));
    expect($unusedCategory->fresh())->toBeNull();
});

it('creates updates searches and deletes payment methods', function () {
    $this->actingAs(User::factory()->admin()->create());

    $this->post(route('admin.payment-methods.store'), ['name' => 'Kartu'])
        ->assertRedirect(route('admin.payment-methods.index'));
    $method = PaymentMethod::query()->where('name', 'Kartu')->firstOrFail();

    $this->get(route('admin.payment-methods.index', ['search' => 'Kartu']))
        ->assertOk()
        ->assertSee('Kartu');

    $this->put(route('admin.payment-methods.update', $method), ['name' => 'Kartu debit'])
        ->assertRedirect(route('admin.payment-methods.index'));
    expect($method->fresh()->name)->toBe('Kartu debit');

    $this->delete(route('admin.payment-methods.destroy', $method))
        ->assertRedirect(route('admin.payment-methods.index'));
    expect($method->fresh())->toBeNull();
});

it('creates updates searches and deletes couriers', function () {
    $this->actingAs(User::factory()->admin()->create());

    $this->post(route('admin.couriers.store'), ['name' => 'Budi', 'phone' => '081234567890'])
        ->assertRedirect(route('admin.couriers.index'));
    $courier = Courier::query()->where('name', 'Budi')->firstOrFail();

    $this->get(route('admin.couriers.index', ['search' => '081234567890']))
        ->assertOk()
        ->assertSee('Budi');

    $this->put(route('admin.couriers.update', $courier), ['name' => 'Budi Santoso', 'phone' => '081111111111'])
        ->assertRedirect(route('admin.couriers.index'));
    expect($courier->fresh()->name)->toBe('Budi Santoso');

    $this->delete(route('admin.couriers.destroy', $courier))
        ->assertRedirect(route('admin.couriers.index'));
    expect($courier->fresh())->toBeNull();
});

it('prevents deleting cities and couriers that are still used by other records', function () {
    $this->actingAs(User::factory()->admin()->create());
    $city = City::factory()->create();
    $customer = Customer::factory()->create(['city_id' => $city->id]);
    $courier = Courier::factory()->create();
    $paymentMethod = PaymentMethod::factory()->create();
    $order = Order::factory()->create([
        'customer_id' => $customer->id,
        'courier_id' => $courier->id,
        'payment_method_id' => $paymentMethod->id,
    ]);

    $this->delete(route('admin.cities.destroy', $city))
        ->assertRedirect()
        ->assertSessionHas('error');
    $this->delete(route('admin.customers.destroy', $customer))
        ->assertRedirect()
        ->assertSessionHas('error');
    $this->delete(route('admin.couriers.destroy', $courier))
        ->assertRedirect()
        ->assertSessionHas('error');
    $this->delete(route('admin.payment-methods.destroy', $paymentMethod))
        ->assertRedirect()
        ->assertSessionHas('error');

    expect($city->fresh())->not->toBeNull()
        ->and($customer->fresh())->not->toBeNull()
        ->and($courier->fresh())->not->toBeNull()
        ->and($paymentMethod->fresh())->not->toBeNull()
        ->and($order->fresh())->not->toBeNull();
});

it('creates searches updates and deletes customers', function () {
    $this->actingAs(User::factory()->admin()->create());
    $city = City::factory()->create();

    $this->post(route('admin.customers.store'), [
        'name' => 'Siti Aminah',
        'phone' => '081234567890',
        'city_id' => $city->id,
    ])->assertRedirect(route('admin.customers.index'));
    $customer = Customer::query()->where('name', 'Siti Aminah')->firstOrFail();

    $this->get(route('admin.customers.index', ['search' => $city->name]))
        ->assertOk()
        ->assertSee('Siti Aminah');

    $this->put(route('admin.customers.update', $customer), [
        'name' => 'Siti A.',
        'phone' => '082222222222',
        'city_id' => $city->id,
    ])->assertRedirect(route('admin.customers.index'));
    expect($customer->fresh()->name)->toBe('Siti A.');

    $this->delete(route('admin.customers.destroy', $customer))
        ->assertRedirect(route('admin.customers.index'));
    expect($customer->fresh())->toBeNull();
});

it('creates searches updates filters and protects menus used in order items', function () {
    $this->actingAs(User::factory()->admin()->create());
    $category = Category::factory()->create(['name' => 'Hidangan Nusantara']);
    $otherCategory = Category::factory()->create(['name' => 'Minuman']);
    $otherMenu = Menu::factory()->create(['name' => 'Es Teh', 'category_id' => $otherCategory->id]);

    $this->post(route('admin.menus.store'), [
        'name' => 'Rendang',
        'price' => 45000,
        'category_id' => $category->id,
    ])->assertRedirect(route('admin.menus.index'));
    $menu = Menu::query()->where('name', 'Rendang')->firstOrFail();

    $this->get(route('admin.menus.index', ['search' => 'Rendang', 'category_id' => $category->id]))
        ->assertOk()
        ->assertSee('Rendang')
        ->assertSee('Hidangan Nusantara')
        ->assertDontSee('Es Teh');

    $this->put(route('admin.menus.update', $menu), [
        'name' => 'Rendang sapi',
        'price' => 50000,
        'category_id' => $otherCategory->id,
    ])->assertRedirect(route('admin.menus.index'));
    expect($menu->fresh()->price)->toBe(50000)
        ->and($menu->fresh()->category_id)->toBe($otherCategory->id);

    $order = makeAdminCrudOrder();
    OrderItem::factory()->create([
        'order_id' => $order->id,
        'menu_id' => $menu->id,
    ]);
    $this->delete(route('admin.menus.destroy', $menu))
        ->assertRedirect()
        ->assertSessionHas('error');
    expect($menu->fresh())->not->toBeNull();
});

it('creates searches updates and deletes orders with their items', function () {
    $this->actingAs(User::factory()->admin()->create());
    $order = makeAdminCrudOrder();

    $this->get(route('admin.orders.index', ['search' => $order->customer->name]))
        ->assertOk()
        ->assertSee($order->customer->name);

    $this->post(route('admin.orders.store'), [
        'customer_id' => $order->customer_id,
        'payment_method_id' => $order->payment_method_id,
        'courier_id' => $order->courier_id,
        'status' => 'menunggu',
    ])->assertRedirect(route('admin.orders.index'));
    expect(Order::query()->where('status', 'menunggu')->exists())->toBeTrue();

    $newCustomer = Customer::factory()->create();
    $this->put(route('admin.orders.update', $order), [
        'customer_id' => $newCustomer->id,
        'payment_method_id' => $order->payment_method_id,
        'courier_id' => $order->courier_id,
        'status' => 'diproses',
    ])->assertRedirect(route('admin.orders.index'));
    expect($order->fresh()->status)->toBe('diproses')
        ->and($order->fresh()->customer_id)->toBe($newCustomer->id);

    $item = OrderItem::factory()->create(['order_id' => $order->id]);
    $this->delete(route('admin.orders.destroy', $order))
        ->assertRedirect(route('admin.orders.index'));
    expect(Order::query()->whereKey($order->id)->exists())->toBeFalse()
        ->and(OrderItem::query()->whereKey($item->id)->exists())->toBeFalse();
});

it('creates and updates order items with a subtotal calculated from menu price and quantity', function () {
    $this->actingAs(User::factory()->admin()->create());
    $order = makeAdminCrudOrder();
    $category = Category::factory()->create(['name' => 'Utama']);
    $otherCategory = Category::factory()->create(['name' => 'Minuman']);
    $menu = Menu::factory()->create(['price' => 12500, 'category_id' => $category->id]);
    $otherMenu = Menu::factory()->create(['name' => 'Es Teh', 'category_id' => $otherCategory->id]);

    $this->post(route('admin.order-items.store'), [
        'order_id' => $order->id,
        'menu_id' => $menu->id,
        'qty' => 3,
        'subtotal' => 1,
    ])->assertRedirect(route('admin.order-items.index'));
    $item = OrderItem::query()->where('order_id', $order->id)->firstOrFail();
    expect($item->subtotal)->toBe(37500);
    OrderItem::factory()->create(['order_id' => $order->id, 'menu_id' => $otherMenu->id]);

    $this->put(route('admin.order-items.update', $item), [
        'order_id' => $order->id,
        'menu_id' => $menu->id,
        'qty' => 4,
    ])->assertRedirect(route('admin.order-items.index'));
    expect($item->fresh()->subtotal)->toBe(50000);

    $this->get(route('admin.order-items.index', [
        'search' => $menu->name,
        'category_id' => $category->id,
    ]))
        ->assertOk()
        ->assertSee($menu->name)
        ->assertDontSee($otherMenu->name)
        ->assertSee('Rp 50.000');

    $this->delete(route('admin.order-items.destroy', $item))
        ->assertRedirect(route('admin.order-items.index'));
    expect($item->fresh())->toBeNull();
});

it('grants admin access to an existing account through the artisan command', function () {
    $user = User::factory()->create();

    $this->artisan('app:promote-user-to-admin', ['email' => $user->email])
        ->expectsOutput("Admin access granted to {$user->email}.")
        ->assertSuccessful();

    expect($user->fresh()->isAdmin())->toBeTrue();
});
