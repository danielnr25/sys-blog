<?php

namespace App\Http\Controllers;

use App\Librerias\Libreria;
use App\Models\Category;
use App\Traits\CRUDTrait;
use Illuminate\Http\Request;

class CategoryController extends Controller

{

    use CRUDTrait;

    public function __construct()
    {
        $this->model        = new Category();
        $this->entity       = 'category';
        $this->folderview   = 'admin.category';
        $this->adminTitle   = __('maintenance.admin.category.title');
        $this->addTitle     = __('maintenance.general.add', ['entity' => $this->adminTitle]);
        $this->updateTitle  = __('maintenance.general.edit', ['entity' => $this->adminTitle]);
        $this->deleteTitle  = __('maintenance.general.delete', ['entity' => $this->adminTitle]);
        $this->routes = [
            'search'  => 'category.search',
            'index'   => 'category.index',
            'store'   => 'category.store',
            'delete'  => 'category.delete',
            'create'  => 'category.create',
            'edit'    => 'category.edit',
            'update'  => 'category.update',
            'destroy' => 'category.destroy',
        ];
        $this->idForm = 'formMantenimiento' . $this->entity;
        $this->clsLibreria = new Libreria();
        $this->headers =[
            [
                'valor'  => 'Meta Titulo',
                'numero' => '1',
            ],
            [
                'valor'  => 'Meta Descripcion',
                'numero' => '1',
            ],
            [
                'valor'  => 'Titulo',
                'numero' => '1',
            ],
            [
                'valor'  => 'Slug',
                'numero' => '1',
            ],
            [
                'valor'  => 'Descripción',
                'numero' => '1',
            ],
            [
                'valor'  => 'imagen',
                'numero' => '1',
            ],
            [
                'valor'  => 'Acciones',
                'numero' => '1',
            ]
        ];
    }

    public function search(Request $request){

        try {
            $paginas = $request->page;
            $filas = $request->filas;

            $title  = $this->getParam($request->title);
            $result = $this->model::search($title);
            $list   = $result->get();

            if(count($list)>0){
                $paramPaginacion = $this->clsLibreria->generarPaginacion($list, $paginas, $filas, $this->entity);
                $request->replace(array('page' => $paramPaginacion['nuevapagina']));
                return view($this->folderview . '.list')->with([
                    'lista'             => $list,
                    'cabecera'          => $this->headers,
                    'titulo_admin'      => $this->adminTitle,
                    'titulo_eliminar'   => $this->deleteTitle,
                    'titulo_modificar'  => $this->updateTitle,
                    'paginacion'        => $paramPaginacion['cadenapaginacion'],
                    'inicio'            => $paramPaginacion['inicio'],
                    'fin'               => $paramPaginacion['fin'],
                    'ruta'              => $this->routes,
                    'entidad'           => $this->entity,
                ]);
            }
            return view($this->folderview . '.list')->with('lista', $list)->with([
                'entidad'           => $this->entity,
            ]);
        } catch (\Throwable $th) {
            return $this->MessageResponse($th->getMessage(), 'danger');
        }
    }

    public function index()
    {
        try {
            return view($this->folderview . '.index')->with([
                'entidad'           => $this->entity,
                'titulo_admin'      => $this->adminTitle,
                'titulo_eliminar'   => $this->deleteTitle,
                'titulo_modificar'  => $this->updateTitle,
                'titulo_registrar'  => $this->addTitle,
                'ruta'              => $this->routes,
                'cboRangeFilas'     => $this->cboRangeFilas(),
            ]);
        } catch (\Throwable $th) {
            return $this->MessageResponse($th->getMessage(), 'danger');
        }
    }


    public function create(Request $request)
    {
        try {
            $formData = [
                'route'             => $this->routes['store'],
                'method'            => 'POST',
                'class'             => 'flex flex-col space-y-3 py-2',
                'id'                => $this->idForm,
                'autocomplete'      => 'off',
                'entidad'           => $this->entity,
                'listar'            => $this->getParam($request->input('listagain'), 'NO'),
                'boton'             => 'Registrar',
            ];
            return view($this->folderview . '.create')->with(compact('formData'));
        } catch (\Throwable $th) {
            return $this->MessageResponse($th->getMessage(), 'danger');
        }
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Category $category)
    {
        //
    }


    public function edit(Category $category)
    {
        //
    }


    public function update(Request $request, Category $category)
    {
        //
    }


    public function destroy(Category $category)
    {
        //
    }
}
