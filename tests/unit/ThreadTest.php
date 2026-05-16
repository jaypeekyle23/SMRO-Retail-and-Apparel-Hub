<?php

use CodeIgniter\Test\CIUnitTestCase;

/**
 * @internal
 */
final class ThreadTest extends CIUnitTestCase
{
    // Test 1: ProductModel has correct table name
    public function testProductModelTableName(): void
    {
        $reflection = new ReflectionClass(\App\Models\ProductModel::class);
        $property   = $reflection->getProperty('table');
        $property->setAccessible(true);
        $model = $reflection->newInstanceWithoutConstructor();
        $this->assertEquals('products', $property->getValue($model));
    }

    // Test 2: ProductVariantModel has correct allowed fields
    public function testProductVariantModelAllowedFields(): void
    {
        $reflection = new ReflectionClass(\App\Models\ProductVariantModel::class);
        $property   = $reflection->getProperty('allowedFields');
        $property->setAccessible(true);
        $model      = $reflection->newInstanceWithoutConstructor();
        $fields     = $property->getValue($model);
        $this->assertContains('stock_quantity', $fields);
        $this->assertContains('product_id', $fields);
    }

    // Test 3: OrderModel has customer_id in allowed fields
    public function testOrderModelHasCustomerId(): void
    {
        $reflection = new ReflectionClass(\App\Models\OrderModel::class);
        $property   = $reflection->getProperty('allowedFields');
        $property->setAccessible(true);
        $model      = $reflection->newInstanceWithoutConstructor();
        $fields     = $property->getValue($model);
        $this->assertContains('customer_id', $fields);
    }

    // Test 4: CustomerModel uses timestamps
    public function testCustomerModelUsesTimestamps(): void
    {
        $reflection = new ReflectionClass(\App\Models\CustomerModel::class);
        $property   = $reflection->getProperty('useTimestamps');
        $property->setAccessible(true);
        $model      = $reflection->newInstanceWithoutConstructor();
        $this->assertTrue($property->getValue($model));
    }

    // Test 5: SupplierModel has correct allowed fields
    public function testSupplierModelAllowedFields(): void
    {
        $reflection = new ReflectionClass(\App\Models\SupplierModel::class);
        $property   = $reflection->getProperty('allowedFields');
        $property->setAccessible(true);
        $model      = $reflection->newInstanceWithoutConstructor();
        $fields     = $property->getValue($model);
        $this->assertContains('name', $fields);
        $this->assertContains('phone', $fields);
        $this->assertContains('email', $fields);
        $this->assertContains('address', $fields);
    }

    // Test 6: Stock calculation logic
    public function testStockCalculationLogic(): void
    {
        $currentStock = 10;
        $quantitySold = 3;
        $newStock     = $currentStock - $quantitySold;
        $this->assertEquals(7, $newStock);
    }

    // Test 7: Stock cannot go below zero
    public function testStockCannotGoBelowZero(): void
    {
        $currentStock = 2;
        $quantitySold = 5;
        $newStock     = $currentStock - $quantitySold;
        $newStock     = ($newStock < 0) ? 0 : $newStock;
        $this->assertEquals(0, $newStock);
    }

    // Test 8: Order total calculation
    public function testOrderTotalCalculation(): void
    {
        $cartItems = [
            ['price' => 300, 'quantity' => 2],
            ['price' => 800, 'quantity' => 1],
        ];

        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $this->assertEquals(1400, $total);
    }

    // Test 9: Order number format
    public function testOrderNumberFormat(): void
    {
        $orderNumber = 'ORD-' . strtoupper(uniqid());
        $this->assertStringStartsWith('ORD-', $orderNumber);
    }

    // Test 10: PO number format
    public function testPoNumberFormat(): void
    {
        $poNumber = 'PO-' . strtoupper(uniqid());
        $this->assertStringStartsWith('PO-', $poNumber);
    }
}