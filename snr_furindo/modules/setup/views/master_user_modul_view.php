<section class="content-header">
    <h1>Akses Modul Pengguna</h1>
</section>

<section class="content">
    <div class="box box-primary">

        <div class="box-body">

            <div class="row">
                <div class="col-sm-4">
                    <form id="formUserModul" action="setup/SetUserModul" method="post">
                        <div class="form-group">
                            <label for="userGroup">Daftar Group Pengguna</label>
                            <select id="userGroup" name="userGroup" class="form-control">
                                <option value="">:: Pilih Group Pengguna ::</option>
                                <?php foreach ($daftarGroupUser as $row) { echo "<option value='". $row[ 'IDUserGroup']. "'>".$row[ 'NamaUserGroup']. "</option>"; } ?>
                            </select>
                        </div>
                        <input type="hidden" id="userGroupTreeviewData" name="userGroupTreeviewData" />
                        <input type="hidden" id="IDUserModul" name="IDUserModul" />
                    </form>

                    <div class="form-group">
                        <label>Daftar Pengguna <span class="badge" id="jmlUserGroup"></span>
                        </label>
                        <div class="form-control" style="overflow:scroll;min-height:328px">
                            <ul class="list-group"></ul>
                        </div>
                    </div>
                    <!-- <div class="form-group"> -->

                </div>
                <!-- <div class="box-body"> -->

                <div class="col-sm-8">
                    <div class="form-group">
                        <div class="form-control" style="overflow:scroll;min-height:392px;margin-top:25px;">
                            <div id="ajaxTreeGridUserModul"></div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button class="btn btn-primary" id="btnSetUserModul"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>&nbsp;Simpan</button>
                    </div>
                </div>
                <!-- <div class="col-sm-8"> -->
            </div>
        </div>

    </div>
</section>

<script>
$(document).ready(function(e) {


    $('#formUserModul').submit(function(e) {
        e.preventDefault();
        sendRequestForm($(this).attr('action'), $(this).serialize(), 'box-body');
        $(window).scrollTop(0);
    });

    $('#userGroup').change(function(e) {
        e.preventDefault();
        $("#ajaxTreeGridUserModul").jqxTreeGrid('clear');
        $('.list-group-item').remove();
        sendRequestForm('setup/GetDaftarGroupUserModul', {
            IDGroup: $(this).val()
        }, 'list-group');
        loadGridData();
    });

    $('#btnSetUserModul').click(function(e) {
        e.preventDefault();

        $('#userGroupTreeviewData').val('');

        $('.jqx-checkbox-check-checked, .jqx-checkbox-check-indeterminate').each(function(e) {
            var dataUserGroupModul = $(this).parent().parent().parent().find('td').eq(2).html();
            dataUserGroupModul = $.parseJSON(dataUserGroupModul);

            var idX = dataUserGroupModul.IDModul;

            $('#userGroupTreeviewData').val($('#userGroupTreeviewData').val() + idX + ',');

        });

        $('#formUserModul').submit();

    });

    loadGridData();

});

function resetForm() {
    $('select').val('');
    $('.list-group-item').remove();
}

function loadGridData() {

    var source = {
        dataType: "json",
        dataFields: [{
            name: "name",
            type: "string"
        }, {
            name: "id",
            type: "number"
        }, {
            name: "action",
            type: "string"
        }, {
            name: "dataList",
            type: "string"
        }, {
            name: "children",
            type: "array"
        }],
        hierarchy: {
            root: "children"
        },
        url: "setup/GetDaftarUserModul",
        id: "id"
    };

    var sourceComboBox = {
        datatype: "json",
        datafields: [{
            name: 'crudID'
        }, {
            name: 'crudName'
        }],
        id: 'id',
        url: 'setup/GetCRUD',
        async: false
    };

    var dataAdapter = new $.jqx.dataAdapter(source, {
        loadComplete: function() {

            recursiveDeep(200, 0);

            dataAkses = $('#userGroupTreeviewData').val();

            var arrDataAkses = dataAkses.split(",");

            for (i = 0; i < arrDataAkses.length; i++) {

                var row = $("#ajaxTreeGridUserModul").jqxTreeGrid('getRow', arrDataAkses[i]);
                var data = $.parseJSON(row.dataList);

                if (data.Header == '0') {
                    $('#ajaxTreeGridUserModul').jqxTreeGrid('checkRow', arrDataAkses[i]);
                }

            }

        }
    });

    var dataAdapterComboBox = new $.jqx.dataAdapter(sourceComboBox, {
        loadComplete: function() {}
    });

    // create jqxTreeGrid.
    $("#ajaxTreeGridUserModul").jqxTreeGrid({
        source: dataAdapter,
        altRows: true,
        width: '100%',
        editable: true,
        selectionMode: 'singleRow',
        hierarchicalCheckboxes: true,
        checkboxes: true,
        ready: function() {
            $("#ajaxTreeGridUserModul").jqxTreeGrid('clear');
        },
        columns: [{
            text: "Modul",
            align: "left",
            dataField: "name",
            width: '60%',
            editable: false
        }, {
            text: "",
            align: "left",
            width: '40%',
            columnType: 'custom',
            createEditor: function(row, cellvalue, editor, cellText, width, height) {

                var currentRow = $("#ajaxTreeGridUserModul").jqxTreeGrid('getRow', row);
                var data = $.parseJSON(currentRow.dataList);

                if (data.Header == '0') {
                    if (data.IsModulReport == '0') {
                        $("<input type='checkbox' value='1' id='tambah'>&nbsp;Tambah</input>&nbsp;<input type='checkbox' value='1' id='ubah'>&nbsp;Ubah</input>&nbsp;<input type='checkbox' value='1' id='hapus'>&nbsp;Hapus</input>").appendTo(editor);
                    } else {
                        $("<input type='checkbox' value='1' id='Cetak'>&nbsp;Cetak</input>").appendTo(editor);
                    }
                }


            },
            initEditor: function(row, cellvalue, editor, celltext, width, height) {
                // set the editor's current value. The callback is called each time the editor is displayed.
                //editor.jqxComboBox('selectItem', cellvalue);
                /* editor.find('input[type="checkbox"]').bind('change', function (value) {
	                    	 curValue = this.value;
	                    	 //alert(curValue)
	                    	 //alert($(this).parent().parent().parent().parent().parent().parent().find('td').eq(2).html());
	                 	});
						*/
            },
            getEditorValue: function(row, cellvalue, editor) {
                // return the editor's value.
            }
        }, {
            text: "Data",
            align: "left",
            dataField: "dataList",
            hidden: true
        }, ]
    });

    function recursiveDeep(max, counter) {
        $('#ajaxTreeGridUserModul').jqxTreeGrid('expandRow', counter);
        counter++;

        counter <= max ? recursiveDeep(max, counter) : '';
    }
}
</script>
