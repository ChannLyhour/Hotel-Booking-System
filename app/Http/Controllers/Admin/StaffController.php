<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StaffRequest;
use App\Services\StaffService;

class StaffController extends Controller
{
    protected $staffService;

    public function __construct(StaffService $staffService)
    {
        $this->staffService = $staffService;
    }

    public function index()
    {
        $staff = $this->staffService->getAllStaff();
        return view('admin.staff.index', compact('staff'));
    }

    public function store(StaffRequest $request)
    {
        $this->staffService->createStaff($request->validated());
        return redirect()->back()->with('success', 'Staff member created successfully.');
    }

    public function update(StaffRequest $request, string $id)
    {
        $this->staffService->updateStaff($id, $request->validated());
        return redirect()->back()->with('success', 'Staff member updated successfully.');
    }

    public function destroy(string $id)
    {
        $this->staffService->deleteStaff($id);
        return redirect()->back()->with('success', 'Staff member deleted successfully.');
    }
}
