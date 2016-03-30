function benefactorTable(){


                //first we must destroy table to be able to initialize it again
                $('#benefactor_table').dataTable().fnClearTable();
                $("#benefactor_table").dataTable().fnDestroy();

                //generating an instance of the table and calling an ajax to retrieve data from database
                person_table_data = $('#benefactor_table').DataTable({

                responsive: true,
                bAutoWidth:false,

                //adding id and class to each row that is created       
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                      nRow.setAttribute('data-id',aData.row_id);
                },

                "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {


                  oSettings.jqXHR = $.ajax( {
                  "dataType": 'json',
                  "type": "GET",
                  "url": sSource,
                  "data": aoData,
                "success": function (data) {

                    //transferring data to global data which will be used below
                    benefactor_table = data;
                    console.log(benefactor_table);
                    fnCallback(data);
                }
                });
                },
               

                "sAjaxSource": "/retrieve/benefactor_table",
                "sAjaxDataProp": "",
                "iDisplayLength": 10,
                "scrollCollapse": false,
                "paging":         true,
                "searching": true,


                //generating columns, now we have to matched column numbers to number of td from the table.
                "columns": [
                    
                  
                    { "mRender" : function ( data, type, full ) { 
                        return "000"+full.ben_id ; 
                    }
                    },
                    { "mData": "ben_name", sDefaultContent: ""},
                    { sDefaultContent: "edit" ,
                     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                          
                                $(nTd).html(' <a href="#" onclick="singleUpdate(this);" data-id="'+oData.ben_id+'" data-val="'+oData.ben_name+'" data-url="benefatorSaving" data-table="benefactorTable" data-title="Benefactor" data-sourceName="ben_name" data-sourceId="ben_id" class="btn btn-primary bg" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a>');

                    }
                    },
                    { sDefaultContent: "edit" ,
                     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                          
                        $(nTd).html(' <a href="#" onclick="singleDelete(this);" data-id="'+oData.ben_id+'" data-val="'+oData.ben_name+'" data-url="benefatorDelete" data-table="benefactorTable" data-title="Benefactor" data-sourceName="ben_name" data-sourceId="ben_id" class="btn btn-danger bg delete_row" data-toggle="modal"><i class="fa fa-pencil"></i> Delete</a>');

                    }
                    },

                    ]

            });

}



function projectTable(){


                //first we must destroy table to be able to initialize it again
                $('#project_table').dataTable().fnClearTable();
                $("#project_table").dataTable().fnDestroy();

                //generating an instance of the table and calling an ajax to retrieve data from database
                person_table_data = $('#project_table').DataTable({

                responsive: true,
                bAutoWidth:false,

                //adding id and class to each row that is created       
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                      nRow.setAttribute('data-id',aData.row_id);
                },

                "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {


                  oSettings.jqXHR = $.ajax( {
                  "dataType": 'json',
                  "type": "GET",
                  "url": sSource,
                  "data": aoData,
                "success": function (data) {

                    //transferring data to global data which will be used below
                    project_table = data;
                    console.log(project_table);
                    fnCallback(data);
                }
                });
                },
               

                "sAjaxSource": "/retrieve/project_table",
                "sAjaxDataProp": "",
                "iDisplayLength": 10,
                "scrollCollapse": false,
                "paging":         true,
                "searching": true,


                //generating columns, now we have to matched column numbers to number of td from the table.
                "columns": [
                    
                  
                    { "mRender" : function ( data, type, full ) { 
                        return "000"+full.proj_id ; 
                    }
                    },
                    { "mData": "proj_name", sDefaultContent: ""},
                    { sDefaultContent: "edit" ,
                     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                          
                                $(nTd).html(' <a href="#" onclick="singleUpdate(this);" data-id="'+oData.proj_id+'" data-val="'+oData.proj_name+'" data-url="projectSaving" data-table="projectTable" data-title="Project" data-sourceName="proj_name" data-sourceId="proj_id" class="btn btn-primary bg" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a>');

                    }
                    },
                    { sDefaultContent: "edit" ,
                     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                          
                        $(nTd).html(' <a href="#" onclick="singleDelete(this);" data-id="'+oData.proj_id+'" data-val="'+oData.proj_name+'" data-url="projectDelete" data-table="projectTable" data-title="Project" data-sourceName="proj_name" data-sourceId="proj_id" class="btn btn-danger bg delete_row" data-toggle="modal"><i class="fa fa-pencil"></i> Delete</a>');

                    }
                    },

                    ]

            });

}




function qualificationTable(){


                //first we must destroy table to be able to initialize it again
                $('#qualification_table').dataTable().fnClearTable();
                $("#qualification_table").dataTable().fnDestroy();

                //generating an instance of the table and calling an ajax to retrieve data from database
                person_table_data = $('#qualification_table').DataTable({

                responsive: true,
                bAutoWidth: false,

                //adding id and class to each row that is created       
                "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                      nRow.setAttribute('data-id',aData.row_id);
                },

                "fnServerData": function ( sSource, aoData, fnCallback, oSettings ) {


                  oSettings.jqXHR = $.ajax( {
                  "dataType": 'json',
                  "type": "GET",
                  "url": sSource,
                  "data": aoData,
                "success": function (data) {

                    //transferring data to global data which will be used below
                    qualification_table = data;
                    console.log(qualification_table);
                    fnCallback(data);
                }
                });
                },
               

                "sAjaxSource": "/retrieve/qualification_table",
                "sAjaxDataProp": "",
                "iDisplayLength": 10,
                "scrollCollapse": false,
                "paging":         true,
                "searching": true,


                //generating columns, now we have to matched column numbers to number of td from the table.
                "columns": [
                    
                  
                    { "mRender" : function ( data, type, full ) { 
                        return "000"+full.qual_id ; 
                    }
                    },
                    { "mData": "qual_name", sDefaultContent: ""},
                    { sDefaultContent: "edit" ,
                     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                          
                                $(nTd).html(' <a href="#" onclick="singleUpdate(this);" data-id="'+oData.qual_id+'" data-val="'+oData.qual_name+'" data-url="qualificationSaving" data-table="qualificationTable" data-title="Qualification" data-sourceName="qual_name" data-sourceId="qual_id" class="btn btn-primary bg" data-toggle="modal"><i class="fa fa-pencil"></i> Edit</a>');

                    }
                    },
                    { sDefaultContent: "edit" ,
                     "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                          
                        $(nTd).html(' <a href="#" onclick="singleDelete(this);" data-id="'+oData.qual_id+'" data-val="'+oData.qual_name+'" data-url="projectDelete" data-table="qualificationTable" data-title="Qualification" data-sourceName="qual_name" data-sourceId="qual_id" class="btn btn-danger bg delete_row" data-toggle="modal"><i class="fa fa-pencil"></i> Delete</a>');

                    }
                    },

                    ]

            });

}