<template>
    <div id="list_inventories">
        <div class="container">
            <button class="btn btn-outline-primary" @click="getSelectedRows()">Get Selected Rows</button>

            <!--            <ag-grid-vue style="width: 100%; height: 500px;"-->
            <!--                         class="ag-theme-balham "-->
            <!--                         :columnDefs="columnDefs"-->
            <!--                         :rowData="rowData"-->
            <!--                         rowSelection="multiple"-->
            <!--                         :defaultColDef="defaultColDef"-->
            <!--                         :columnTypes="columnTypes"-->
            <!--                         :gridOptions="gridOptions"-->
            <!--                         :defaultColGroupDef="defaultColGroupDef"-->
            <!--                         :locale-text="localeText"-->
            <!--                         @grid-ready="onGridReady"-->
            <!--                         :animateRows="true"-->
            <!--                         :sideBar="sideBar"-->
            <!--                         :statusBar="statusBar"-->
            <!--                         :floatingFilter="true"-->
            <!--            >-->
            <!--            </ag-grid-vue>-->

            <ag-grid-vue style="width: 100%; height: 600px;" class="ag-theme-balham" id="myGrid"
                         :gridOptions="gridOptions"
                         @grid-ready="onGridReady"
                         :columnDefs="columnDefs2"
                         :masterDetail="true"
                         :detailCellRendererParams="detailCellRendererParams"
                         :rowData="rowData"></ag-grid-vue>
        </div>
    </div>
</template>

<script>
    import {AgGridVue} from "ag-grid-vue";
    import 'ag-grid-enterprise'
    import localeText from '@/lang/agGrid'

    // import donner from '@/data/data'
    import donner from '@/data/nested'

    export default {
        name: "InventoryList",
        data() {
            return {
                localeText,
                columnDefs: null,
                columnDefs2: null,
                rowData: null,
                gridApi: null,

                columnApi: null,

                autoGroupColumnDef: null,
                defaultColDef: null,
                columnTypes: null,

                gridOptions: null,

                gridColumnApi: null,

                sideBar: null,
                statusBar: null,

                detailCellRendererParams: null,

                donner
            }
        },
        mounted() {
            this.gridApi = this.gridOptions.api;
            this.gridColumnApi = this.gridOptions.columnApi;
        },
        components: {
            AgGridVue
        },
        methods: {
            onGridReady(params) {
                this.gridApi = params.api;
                this.columnApi = params.columnApi;
            },
            getSelectedRows() {
                const selectedNodes = this.gridApi.getSelectedNodes();
                const selectedData = selectedNodes.map(node => node.data);
                const selectedDataStringPresentation = selectedData.map(node => node.make + ' ' + node.model).join(', ');
                alert(`Selected nodes: ${selectedDataStringPresentation}`);
            }
        },
        beforeMount() {
            this.gridOptions = {};

            this.sideBar = {
                toolPanels: ["filters", "columns"]
            };

            this.statusBar = {
                statusPanels: [
                    {
                        statusPanel: "agTotalRowCountComponent",
                        align: "left",
                        key: "totalRowComponent"
                    },
                    {
                        statusPanel: "agFilteredRowCountComponent",
                        align: "left"
                    },
                    {
                        statusPanel: "agSelectedRowCountComponent",
                        align: "center"
                    },
                    {
                        statusPanel: "agAggregationComponent",
                        align: "right"
                    }
                ]
            };

            this.columnDefs2 = [
                {
                    field: "name",
                    cellRenderer: "agGroupCellRenderer"
                },
                {field: "account"},
                {field: "calls"},
                {
                    field: "minutes",
                    valueFormatter: "x.toLocaleString() + ' min'"
                }
            ];
            this.columnDefs = [
                {
                    headerName: "Athlete Details",
                    children: [
                        {
                            headerName: "Athlete",
                            field: "athlete",
                            // width: 150,
                            filter: "agTextColumnFilter"
                        },
                        {
                            headerName: "Age",
                            field: "age",
                            // width: 90,
                            filter: "agNumberColumnFilter"
                        },
                        {
                            headerName: "Country",
                            field: "country",
                            // width: 120
                        }
                    ]
                },
                {
                    headerName: "Sports Results",
                    children: [
                        {
                            headerName: "Sport",
                            field: "sport",
                            type: ["nonEditableColumn"],
                            width: 110
                        },
                        {
                            headerName: "Total",
                            field: "total",
                            type: "numberColumn",
                            width: 100,
                        },
                        {
                            headerName: "Gold",
                            columnGroupShow: "open",
                            field: "gold",
                            width: 100,
                            filter: "agNumberColumnFilter"
                        },
                        {
                            headerName: "Silver",
                            columnGroupShow: "open",
                            field: "silver",
                            width: 100,
                            filter: "agNumberColumnFilter"
                        },
                        {
                            headerName: "Bronze",
                            // columnGroupShow: "open",
                            // filter: "agNumberColumnFilter"
                            field: "bronze",
                            width: 100,
                            type: ["medalColumn", "editableColumn"],
                        }
                    ]
                }
            ];

            this.defaultColDef = {
                sortable: true,
                resizable: true,
                // filter: true,
                filter: "agTextColumnFilter"

            };

            this.defaultColGroupDef = {marryChildren: true};

            //NESTED Config
            this.detailCellRendererParams = {
                detailGridOptions: {
                    columnDefs: [
                        {field: "callId"},
                        {field: "direction"},
                        {field: "number"},
                        {
                            field: "duration",
                            valueFormatter: "x.toLocaleString() + 's'"
                        },
                        {field: "switchCode"}
                    ],

                    onFirstDataRendered(params) {
                        params.api.sizeColumnsToFit();
                    }
                },
                getDetailRowData: params => {
                    params.successCallback(params.data.callRecords);
                }
            };

            this.columnTypes = {
                numberColumn: {
                    width: 83,
                    filter: "agNumberColumnFilter"
                },
                medalColumn: {
                    width: 100,
                    columnGroupShow: "open",
                    filter: false
                },
                nonEditableColumn: {editable: false},
                editableColumn: {editable: true},
                dateColumn: {
                    filter: "agDateColumnFilter",
                    filterParams: {
                        comparator: (filterLocalDateAtMidnight, cellValue) => {
                            var dateParts = cellValue.split("/");
                            var day = Number(dateParts[2]);
                            var month = Number(dateParts[1]) - 1;
                            var year = Number(dateParts[0]);
                            var cellDate = new Date(day, month, year);
                            if (cellDate < filterLocalDateAtMidnight) {
                                return -1;
                            } else if (cellDate > filterLocalDateAtMidnight) {
                                return 1;
                            } else {
                                return 0;
                            }
                        }
                    }
                }
            };
            this.rowData = this.donner
        }
    }
</script>

<style>
    .ag-row-hover {
        /* putting in !important so it overrides the theme's styling as it hovers the row also */
        background-color: #dfdfff !important;
    }

    /*.ag-column-hover {*/
    /*    background-color: #dfffdf;*/
    /*}*/

</style>
