<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;
use App\Models\Menu;

class MenuController extends Controller
{
    protected $menuService;


    function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function create() {
        return view('admin.menu.add', [
            'title' => 'Thêm danh mục',
            'menus' => $this->menuService->getParent()
        ]);
    }

    public function store(CreateFormRequest $request)
    {
        $result = $this->menuService->create($request);

        return redirect()->back();
    }

    public function index() {
        return view( 'admin.menu.list',[
            'title' => 'Danh sách danh mục mới nhất',
            'menus' => $this->menuService->getAll(),
        ]);
    }

    public function show(Menu $menu) {
        return view( 'admin.menu.edit',[
            'title' => 'Chỉnh sửa danh mục' . $menu->name,
            'menu' => $menu,
            'menus' => $this->menuService->getAll(),
        ]);
    }

    public function update(Menu $menu, CreateFormRequest $request) {
        $update = $this->menuService->update($request, $menu);
        return redirect('/admin/menus/list');
    }

    public function destroy(Request $request): JsonResponse {
        $result = $this->menuService->destroy($request);

        if ($result) {
            return response()->json([
                'error' => false,
                'message' => 'Xóa thành công danh mục'
            ]);
        }

        return response()->json([
            'error' => true
        ]);
    }

}
