<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Админка</title>
    <link rel="stylesheet" href="{!! asset('../resources/js/codebase/webix.css') !!}">
    <link rel="stylesheet" type="text/css" href="http://cdn.webix.com/components/hint/hint.css">

    <link href="{!! asset('../resources/js/codebase/skins/willow.css') !!}" rel="stylesheet" type="text/css">

    <script src="https://kit.fontawesome.com/9a26736a93.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <script src="{!! asset('../resources/js/codebase/webix.js') !!}"></script>
    <script type="text/javascript" src="https://cdn.webix.com/components/hint/hint.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>

    <script>
        var menu_list = [{
                id: "automobiles",
                icon: "fa-solid fa-car",
                view: "button",
                value: "Бренд/Модель",
                select: true,
            },
            {
                id: "battery",
                icon: "fa-solid fa-car-battery",
                view: "button",
                value: "Аккумуляторы",
                select: false,
            },
            {
                id: "links",
                icon: "fa-solid fa-link",
                view: "button",
                value: "Связки",
                select: false,
            },
        ];

        var main_menu = {
            cols: [{
                view: "sidebar",
                "css": "webix_dark",
                collapsed: true,
                collapsedWidth: 40,
                data: menu_list,
                width: 0,
                height: 0,
            }],
            width: 40,
            height: 0,
            id: 'MENU_1'
        };


        var add_brand = webix.ui({
            view: "window",
            resize: true,
            height: window.innerHeight - (window.innerHeight / 100 * 10),
            width: window.innerWidth - (window.innerWidth / 100 * 35),
            move: true,
            position: "center",
            close: true,
            css: "webix_dark",
            head: "Добавление бренда",
            body: {
                rows: [{
                        "label": "Наименование",
                        "view": "text",
                        "labelWidth": 125,
                        'id': 'add_brand_title'
                    },
                    {
                        "label": "Добавить бренд",
                        "view": "button",
                        on: {
                            onItemClick: function(id, e, node) {
                                if ($$('add_brand_title').getValue() != '') {
                                    $.get('http://localhost/public/api/brands/add', {
                                        'brand_title': $$('add_brand_title').getValue()
                                    }, function(brand) {
                                        if ($$('brands_table').getItem(brand.id) == undefined) {
                                            $$('brands_table').add({
                                                'id': brand.id,
                                                'title': brand.name
                                            });
                                        }
                                    });
                                }
                            }
                        }
                    }
                ]
            }
        });

        var brand_models = {
            "cols": [{
                    "width": 250,
                    "rows": [{
                            "columns": [{
                                    "id": "id",
                                    "header": "ID",
                                    "fillspace": true,
                                    "sort": "string",
                                    'hidden': true
                                },
                                {
                                    "id": "title",
                                    "header": ["Бренд",
                                        {
                                            content: "textFilter"
                                        }
                                    ],
                                    "fillspace": true,
                                    "sort": "string"
                                }
                            ],
                            "view": "datatable",
                            "select": "row",
                            "width": 0,
                            'id': 'brands_table',
                            on: {
                                onItemClick: function(id, e, node) {
                                    var item = this.getItem(id);
                                    $.get('http://localhost/public/api/brands/models/list', {
                                        'brand_id': item.id
                                    }, function(models) {
                                        $$('models_table').clearAll();
                                        models.forEach((model) => {
                                            $$('models_table').add({
                                                'id': model.model_id,
                                                'title': model.model_name
                                            });
                                        });
                                    });
                                }
                            }
                        },
                        {
                            "label": "Добавить",
                            "view": "button",
                            on: {
                                onItemClick: function(id, e, node) {
                                    add_brand.show();
                                }
                            }
                        }
                    ]
                },
                {
                    "width": 0,
                    "rows": [{
                            "columns": [{
                                "id": "id",
                                "header": "ID",
                                "fillspace": true,
                                "sort": "string",
                                'hidden': true
                            }, {
                                "id": "title",
                                "header": ["Модель",
                                    {
                                        content: "textFilter"
                                    }
                                ],
                                "fillspace": true,
                                "sort": "string"
                            }],
                            "view": "datatable",
                            "select": "row",
                            "width": 0,
                            'id': 'models_table',
                        },
                        {
                            "label": "Добавить",
                            "view": "button"
                        }
                    ]
                }
            ]
        };

        $(document).ready(function() {
            $.get('http://localhost/public/api/brands', {}, function(brands) {
                brands.forEach((brand) => {
                    $$('brands_table').add({
                        'id': brand.brand_id,
                        'title': brand.brand_name
                    });
                });
            });
        });

        webix.ui({
            cols: [
                main_menu,
                brand_models
            ]
        });
    </script>
</body>

</html>