<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Review;
use App\Services\ReviewDataAccess;
use App\Repositories\ReviewRepository;
use Illuminate\Support\Facades\Artisan;

//ReviewDataAccessTestを継承
class ReviewRepositoryTest extends ReviewDataAccessTest
{
    use RefreshDatabase;

    protected $Review;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->Review = app(ReviewRepository::class);
    }

    public function tearDown(): void
    {
        Artisan::call('migrate:refresh');
        parent::tearDown();
    }
}
