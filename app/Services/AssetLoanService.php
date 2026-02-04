<?php

namespace App\Services;

use App\Models\Asset;
use App\Models\AssetLoan;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class AssetLoanService
{
    protected $auditService;

    public function __construct(AuditService $auditService)
    {
        $this->auditService = $auditService;
    }

    /**
     * Checkout an asset to a user.
     */
    public function checkout(Asset $asset, User $user, string $notes = null): AssetLoan
    {
        if ($asset->status !== 'available') {
            throw new Exception("Asset is not available for checkout.");
        }

        return DB::transaction(function () use ($asset, $user, $notes) {
            // Create Loan Record
            $loan = AssetLoan::create([
                'asset_id' => $asset->id,
                'user_id' => $user->id,
                'loan_date' => now(),
                'status' => 'borrowed',
                'notes' => $notes,
            ]);

            // Update Asset Status
            $asset->update(['status' => 'deployed']);

            // Log Audit
            $this->auditService->log('CHECKOUT', $asset, [
                'loan_id' => $loan->id,
                'user_id' => $user->id,
                'notes' => $notes
            ]);

            return $loan;
        });
    }

    /**
     * Checkin (return) an asset.
     */
    public function checkin(AssetLoan $loan): void
    {
        if ($loan->status !== 'borrowed') {
            throw new Exception("This loan is already returned.");
        }

        DB::transaction(function () use ($loan) {
            // Update Loan Record
            $loan->update([
                'return_date' => now(),
                'status' => 'returned',
            ]);

            // Update Asset Status
            $asset = $loan->asset;
            $asset->update(['status' => 'available']);

            // Log Audit
            $this->auditService->log('CHECKIN', $asset, [
                'loan_id' => $loan->id
            ]);
        });
    }
}
