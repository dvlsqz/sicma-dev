<?php
    //Rol de usuarios
    function getRoleUserArray($mode, $id){
        $roles = [
            '0' => 'Administrador General',
            '1' => 'Administrador',
            '2' => 'Encargado de Area',
            '3' => 'Operador - Tecnico',
            '4' => 'Bodeguero'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

    //Estado de Usuarios
    function getUserStatusArray($mode, $id){
        $status = [
            '0' => 'Suspendido',
            '1' => 'Activo'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getProductStatusArray($mode, $id){
        $status = [
            '0' => 'Desabastecido',
            '1' => 'Abastecido'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Estado de insumos/herramientas/equipos de Bodega/Inventario
    function getStoreStatusArray($mode, $id){
        $status = [
            '0' => 'Desabastecido',
            '1' => 'Abastecido',
            '2' => 'De baja',
            '3' => 'De alta'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Estado de insumos/herramientas/equipos de Kardex Transitorio
    function getKardexStatusArray($mode, $id){
        $status = [
            '0' => 'Desabastecido',
            '1' => 'Abastecido',
            '2' => 'De baja',
            '3' => 'De alta'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

     //Estado de insumos/herramientas/equipos de Bodega/Inventario
    function getTipoBodegaArray($mode, $id){
        $status = [
            '0' => 'Insumo',
            '1' => 'Herramienta',
            '2' => 'Repuesto',
            '3' => 'Sin Asignar'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getIngresoBodegaArray($mode, $id){
        $status = [
            '0' => 'FACTURA'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    function getEgresoBodegaArray($mode, $id){
        $status = [
            '0' => 'DAB-75',
            '1' => 'ING-7'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para agregar o quitar Inventario / Bodega
    function getFormaBodegaArray($mode, $id){
        $status = [
            '0' => 'DAB-75',
            '1' => 'ING-7',
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para agregar  kardex Transitorio
    function getFormaDABAddArray($mode, $id){
        $status = [
            '0' => 'DAB-75'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para agregar  kardex Transitorio
    function getFormaKardexIncomeArray($mode, $id){
        $status = [
            '0' => 'DAB-75',
            '1' => 'INVENTARIO INICIAL / GENERAL',
            '2' => 'DEVOLUCION',
            '3' => 'VALE EPP'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Forma para quitar kardex Transitorio
    function getFormaKardexEgressArray($mode, $id){
        $status = [           
            '0' => 'ING-7',
            '1' => 'OT´S',
            '2' => 'ASIGNADO',
            '3' => 'VALE EPP'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Estado de equipos y ambientes
    function getStatusEquipEnvironmentArray($mode, $id){
        $status = [
            '0' => 'Activo',
            '1' => 'Inactivo'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }
    //Tipos de manuales de equipos
    function getTypeFilesArray($mode, $id){
        $status = [
            '0' => 'Manual de Usuario',
            '1' => 'Manual Técnico',
            '2' => 'Especificaciones Tecnicas'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Rol de usuarios
    function getLevelEquipment($mode, $id){
        $roles = [
            '0' => 'Bajo',
            '1' => 'Medio',
            '2' => 'Alto'
        ];

        if(!is_null($mode)):
            return $roles;
        else:
            return $roles[$id];
        endif;
    }

     //Estado de insumos/herramientas/equipos de Bodega/Inventario
    function getFrecuenciasUsosArray($mode, $id){
        $status = [
            '0' => 'Diario',
            '1' => '2 veces por semana',
            '2' => 'Semanal',
            '3' => 'Quincenal',
            '4' => 'Mensual',
            '5' => 'Semestral',
            '6' => 'Anual',
            '7' => 'Emergencia'
        ];

        if(!is_null($mode)):
            return $status;
        else:
            return $status[$id];
        endif;
    }

    //Key Value From JSON
    function kvfj($json, $key){
        if($json == null):
            return null;
        else:
            $json = $json;
            $json = json_decode($json, true);

            if(array_key_exists($key, $json)):
                return $json[$key];
            else:
                return null;
            endif;
        endif;
    }

    function user_permissions(){
        $p = [

            'dashboard' => [
                'icon' => '<i class="fas fa-tachometer-alt"></i>',
                'title' => 'Modulo de Dashboard',
                'keys' => [
                    'dashboard' => 'Puede ver el dashboard.',
                    'dashboard_small_stats' => 'Puede ver las estadísticas rápidas.'
                ]
            ],
            'units' => [
                'icon' => '<i class="fas fa-hospital-user"></i>',
                'title' => 'Modulo de Unidades Medicas',
                'keys' => [
                    'units' => 'Puede ver el listado de unidades.',
                    'unit_add' => 'Puede agregar nuevas unidades.',
                    'unit_edit' => 'Puede editar unidades.',
                    'unit_delete' => 'Puede eliminar unidades.',
                    'unit_search' => 'Puede buscar unidades.'
                ]
            ],
            'maintenance_areas' => [
                'icon' => '<i class="fas fa-hard-hat"></i>',
                'title' => 'Modulo de Areas de Mantenimiento',
                'keys' => [
                    'maintenance_areas' => 'Puede ver el listado de areas de mantenimiento.',
                    'maintenance_area_add' => 'Puede agregar nuevas areas de mantenimiento.',
                    'maintenance_area_edit' => 'Puede editar areas de mantenimiento.',
                    'maintenance_area_delete' => 'Puede eliminar areas de mantenimiento.',
                    'maintenance_area_search' => 'Puede buscar areas de mantenimiento.'
                ]
            ],
            'suppliers' => [
                'icon' => '<i class="fas fa-users"></i>',
                'title' => 'Modulo de Proveedores',
                'keys' => [
                    'suppliers' => 'Puede ver el listado de proveedores.',
                    'supplier_add' => 'Puede agregar nuevas proveedores.',
                    'supplier_edit' => 'Puede editar proveedores.',
                    'supplier_delete' => 'Puede eliminar proveedores.',
                    'supplier_search' => 'Puede buscar proveedores.'
                ]
            ],
            'bitacoras' => [
                'icon' => '<i class="fas fa-clipboard-list"></i> ',
                'title' => 'Modulo de Bitacoras',
                'keys' => [
                    'bitacoras' => 'Puede ver el listado de bitacoras.'
                ]
            ],
            'users' => [
                'icon' => '<i class="fas fa-user-lock"></i> ',
                'title' => 'Modulo de Usuarios',
                'keys' => [
                    'user_list' => 'Puede ver el listado de usuarios.',
                    'user_add' => 'Puede agregar nuevos usuarios.',
                    'user_edit' => 'Puede editar usuarios.',
                    'user_banned' => 'Puede suspender usuarios.',
                    'user_delete' => 'Puede eliminar usuarios.',
                    'user_reset_password' => 'Puede restablecer contraseña de usuarios.',
                    'user_permissions' => 'Puede administrar los permisos de los usuarios.',
                    'user_info' => 'Puede ver información de su cuenta',
                    'user_change_password' => 'Puede cambiar su contraseña de inicio de sesión'
                ]
            ],
            'product' => [
                'icon' => '<i class="fas fa-database"></i> ',
                'title' => 'Modulo de Bodega',
                'keys' => [
                    'products_index' => 'Puede ver el listado general.',
                    'product_list' => 'Puede ver el listado de insumos/herramientas/equipos.',
                    'product_add' => 'Puede agregar nuevos insumos/herramientas/equipos.',
                    'product_edit' => 'Puede editar insumos/herramientas/equipos.',
                    'product_banned' => 'Puede dar de baja insumos/herramientas/equipos.',
                    'product_edit_stock' => 'Puede modificar existencias de insumos/herramientas/equipos.',
                    'product_delete' => 'Puede eliminar insumos/herramientas/equipos.',
                    'product_search' => 'Puede buscar insumos/herramientas/equipos.',
                    'product_income' => 'Puede registrar ingresos de productos',
                    'product_egress' => 'Puede registrar egresos de productos',
                    'product_record' => 'Puede visualizar el historial de movimientos.'
                ]
            ],
            'kardex' => [
                'icon' => '<i class="fas fa-server"></i> ',
                'title' => 'Modulo de Kardex',
                'keys' => [
                    'kardex_list' => 'Puede ver el listado de insumos/herramientas/equipos.',
                    'kardex_add' => 'Puede agregar nuevos insumos/herramientas/equipos.',
                    'kardex_edit' => 'Puede editar insumos/herramientas/equipos.',
                    'kardex_banned' => 'Puede dar de baja insumos/herramientas/equipos.',
                    'kardex_edit_stock' => 'Puede modificar existencias de insumos/herramientas/equipos.',
                    'kardex_delete' => 'Puede eliminar insumos/herramientas/equipos.',
                    'kardex_income' => 'Puede registrar ingresos a kardex',
                    'kardex_egress' => 'Puede registrar egresos de kardex'
                ]
            ],
            'dab_fr' => [
                'icon' => '<i class="fas fa-file-signature"></i> ',
                'title' => 'Modulo de Control de DAB-75 para Fondo Rotativo',
                'keys' => [
                    'dabs' => 'Puede ver el listado de DAB-75.',
                    'dabs_add' => 'Puede agregar ó registrar DAB-75.',
                    'dabs_show' => 'Puede ver la informacion y detalles de la DAB-75.'
                ]
            ],
            'equipments' => [
                'icon' => '<i class="fas fa-object-group"></i> ',
                'title' => 'Modulo de Equipos',
                'keys' => [
                    'equipments_list' => 'Puede ver el listado.',
                    'equipment_add' => 'Puede agregar Equipos.',
                    'equipment_edit' => 'Puede editar equipos.',
                    'equipment_file' => 'Puede visualizar y subir archivos',
                    'equipment_data_sheet' => 'Puede generar y/o visualizar la ficha tecnica',
                    'equipment_parts' => 'Puede ver y agregar partes del equipo',
                    'equipment_transfer' => 'Puede ver y registrar cabmios de ambientes',
                    'equipment_banned' => 'Puede dar de baja a equipos.'
                ]
            ],
            'environments' => [
                'icon' => '<i class="fas fa-object-group"></i> ',
                'title' => 'Modulo de Ambientes',
                'keys' => [
                    'serviceg_list' => 'Puede ver el listado de servicios general.',
                    'serviceg_add' => 'Puede agregar servicios genereales.',
                    'serviceg_edit' => 'Puede editar servicios generales.',
                    'service_list' => 'Puede ver el listado de servicios .',
                    'service_add' => 'Puede agregar servicios.',
                    'service_edit' => 'Puede editar servicios.',
                    'environment_list' => 'Puede ver el listado de ambientes .',
                    'environment_add' => 'Puede agregar ambientes.',
                    'environment_edit' => 'Puede editar ambientes.',
                    'environment_banned' => 'Puede dar de baja ambientes.' 
                ]
            ]

        ];

        return $p;
    }

    function getUserYears(){
        $ya = date('Y');
        $ym = $ya - 18;
        $yo = $ym - 62;

        return [$ym, $yo];
    }

    function getMonths($mode, $key){
        $m = [
            '01' => 'Enero',
            '02' => 'Febrero',
            '03' => 'Marzo',
            '04' => 'Abril',
            '05' => 'Mayo',
            '06' => 'Junio',
            '07' => 'Julio',
            '08' => 'Agosto',
            '09' => 'Septiembre',
            '10' => 'Octubre',
            '11' => 'Noviembre',
            '12' => 'Diciembre'
        ];

        if($mode == "list"){
            return $m;
        }else{
            return $m[$key];
        }
    }

?>
