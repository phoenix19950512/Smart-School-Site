<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<link rel="stylesheet" href="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
<style>
    input.form-control[type="file"] {
        opacity: 1;
    }
    input.form-control[type="file"]:focus {
        outline: none;
    }
    #iframe {
        width: 100%;
        height: 100%;
    }
    #parameterPanel {
        margin: 15px auto;
        text-align: left;
        border: 0;
    }
    #parameterPanel td {
        padding: 0;
        border: 1px solid #ccc;
    }
    #parameterPanel td:first-child {
        padding: 5px 10px;
        font-weight: bold;
    }
    #parameterPanel input {
        width: -webkit-fill-available;
        border: 0;
        outline: none;
        padding: 5px 10px;
    }
    #parameterPanel input:focus-visible {
        border: 0;
        outline: none;
    }
    #studnetList {
        display: flex;
        width: 100%;
        padding: 5px 10px;
    }
    .dataTable tbody tr {
        cursor: pointer;
    }
</style>
<script src="<?php echo base_url(); ?>backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<div class="content-wrapper" style="min-height: 946px; display: flex;">
    <section class="content" style="display: flex; flex-direction: column; width: 100%;">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <?php if ($this->session->flashdata('msg')) { ?>
                            <div class="alert alert-success">
                                <?php echo $this->session->flashdata('msg');
                                $this->session->unset_userdata('msg'); ?>
                            </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Select report template</label>
                                            <select autofocus="" id="template_id" name="template_id" class="form-control">
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                foreach ($template_list as $template) {
                                                    ?>
                                                    <option value="<?php echo $template['id'] ?>"><?php echo $template['name'] ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('template_id'); ?></span>
                                        </div>
                                        <button type="button" id="deleteTemp" class="btn btn-danger btn-sm checkbox-toggle" style="float: right;">
                                            <i class="fa fa-times" style="margin-top: 4px; margin-right: 3px;"></i>
                                            Delete This Template
                                        </button>
                                    </div>
                                    <div class="col-sm-10">
                                        <form role="form" action="<?php echo site_url('report/uploadtemp') ?>" method="post" enctype="multipart/form-data" target="iframe">
                                            <?php echo $this->customlib->getCSRF(); ?>
                                            <div class="form-group">
                                                <label>Upload new template</label>
                                                <table style="width: fit-content; table-layout: auto;">
                                                    <tr>
                                                        <td>
                                                            <input type="file" name="jasperfile" class="form-control" accept=".jasper" required>
                                                        </td>
                                                        <td>
                                                            <button type="submit" class="btn btn-primary btn-sm checkbox-toggle">
                                                                <i class="fa fa-upload" style="margin-top: 4px; margin-right: 3px;"></i>
                                                                Upload New Template
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="display: flex; height: -webkit-fill-available; background-color: #fff;">
            <div class="col-md-6">
                <iframe frameborder="0" id="iframe" name="iframe"></iframe>
            </div>
            <div class="col-md-6" style="text-align: center; padding: 20px;">
                <div>
                    <div id="tables" class="table-responsive"></div>
                    <table id="parameterPanel" border="0" cellpadding="0" cellspacing="0"></table>
                </div>
                <button type="button" id="saveaspdf" class="btn btn-primary btn-sm checkbox-toggle" style="display: flex;">
                    <i class="fa fa-file-pdf-o" style="display: flex; margin-top: 3px; margin-right: 3px;"></i>
                    Save as PDF
                </button>
            </div>
        </div>
    </section>
</div>
<script src="<?php echo base_url(); ?>backend/js/html2pdf.bundle.min.js"></script>
<script type="text/javascript">
    const setDataTable = (className) => {
        $(`.${className}`).DataTable({
            dom: 'Bfrtip',
            buttons: [
                // {
                //     extend: 'copy',
                //     text: '<i class="fa fa-files-o"></i>',
                //     titleAttr: 'Copy',
                //     className: 'btn-copy',
                //     title: $(`.${className}`).data('exportTitle'),
                //     exportOptions: {
                //         columns: ['thead th:not(.noExport)']
                //     }
                // },
                // {
                //     extend: 'excel',
                //     text: '<i class="fa fa-file-excel-o"></i>',
                //     titleAttr: 'Excel',
                //     className: 'btn-excel',
                //     title: $(`.${className}`).data('exportTitle'),
                //     exportOptions: {
                //         columns: ['thead th:not(.noExport)']
                //     }
                // },
                // {
                //     extend: 'csv',
                //     text: '<i class="fa fa-file-text-o"></i>',
                //     titleAttr: 'CSV',
                //     className: 'btn-csv',
                //     title: $(`.${className}`).data('exportTitle'),
                //     exportOptions: {
                //         columns: ['thead th:not(.noExport)']
                //     }
                // },
                // {
                //     extend: 'pdf',
                //     text: '<i class="fa fa-file-pdf-o"></i>',
                //     titleAttr: 'PDF',
                //     className: 'btn-pdf',
                //     title: $(`.${className}`).data('exportTitle'),
                //     exportOptions: {
                //         columns: ['thead th:not(.noExport)']
                //     },
                //     customize: function (doc) {
                //         // doc.defaultStyle.font = 'Arial'
                //         doc.defaultStyle.fontSize = 10
                //     }
                // },
                // {
                //     extend: 'print',
                //     text: '<i class="fa fa-print"></i>',
                //     titleAttr: 'Print',
                //     className: 'btn-print',
                //     title: $(`.${className}`).data('exportTitle'),
                //     customize: function (win) {
                //         $(win.document.body)
                //         .find('th')
                //         .addClass('display')
                //         .css('text-align', 'center')
                //         $(win.document.body)
                //         .find('table')
                //         .addClass('display')
                //         .css('font-size', '14px')
                //         $(win.document.body).find('h1').css('text-align', 'center')
                //     },
                //     exportOptions: {
                //         columns: ['thead th:not(.noExport)']
                //     }
                // }
            ],

            columnDefs: [{
                targets: -1,
                orderable: true
            }],

            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> '
            },
            pageLength: 10,
            processing: true,
        });
    }
    const setTrAction = () => {
        const trs = document.querySelectorAll('#tables tbody tr');
        for (const tr of trs) {
            tr.onclick = () => {
                if (tr.innerText === 'No data available in table\n\n\n\n Add new record or search with different criteria.') return;
                tr.querySelector('input[type="radio"]').click();
            }
        }
    }
    $(document).ready(function () {
        const paramDict = JSON.parse('<?php echo $param_dict; ?>');
        const template_id = $('#template_id').val();
        $(document).on('change', '#template_id', function (e) {
            const template_id = $(this).val();
            const iframe = document.getElementById('iframe');
            const doc = iframe.contentDocument || iframe.contentWindow.document;
            doc.open();
            doc.write('');
            doc.close();
            document.getElementById('parameterPanel').innerHTML = '';
            document.getElementById('tables').innerHTML = '';
            if (!template_id || template_id == '') return;
            const base_url = '<?php echo base_url() ?>';
            document.body.style.cursor = 'wait';
            doc.open();
            doc.write('<style>body{cursor:wait}</style>');
            doc.close();
            $.get(`${base_url}/report/setreporttemplate/${template_id}`, (data, status) => {
                if (status == 'success') {
                    doc.open();
                    doc.write(data);
                    doc.close();
                    $.post(`${base_url}/report/getreportparams/${template_id}`, (data, status) => {
                        if (status == 'success') {
                            if (data !== 'No missing parameters found.') {
                                const params = data.toLowerCase().split(',');
                                const parameterPanel = document.getElementById('parameterPanel');
                                const filteredParams = paramDict.filter(item => params.includes(item.name.toLowerCase()));
                                for (const param of params) {
                                    if (!paramDict.find(obj => obj.name.toLowerCase() === param) && param !== 'student_fullname') {
                                        parameterPanel.innerHTML += `<tr><td>${param}</td><td><input type="text" name="${param}"></td></tr>`;
                                    }
                                    if (param === 'student_fullname') {
                                        filteredParams.push({ name: 'firstname', table: 'student', field: 'firstname' });
                                        filteredParams.push({ name: 'lastname', table: 'student', field: 'lastname' });
                                    }
                                }
                                $.post(`${base_url}/report/gettableforparams`, { data: JSON.stringify(filteredParams) }, (data, status) => {
                                    if (status === 'success') {
                                        if (data === 'Something went wrong.') {
                                            alert(data);
                                        } else {
                                            $('#tables').html(data);
                                            const tables = document.querySelectorAll('#tables table');
                                            for (const table of tables) {
                                                const className = table.className.replace('table table-striped table-bordered table-hover ', '').split(' ')[0];
                                                setDataTable(className);
                                            }
                                            setTrAction();
                                        }
                                    } else {
                                        alert('Failed to load data from Database.');
                                    }
                                });
                            }
                        } else {
                            alert('Failed to get parameters from report template.');
                        }
                        document.body.style.cursor = 'initial';
                    });
                } else {
                    alert('Failed to select report template.');
                    document.body.style.cursor = 'initial';
                }
            });
        });
        $('#deleteTemp').click(() => {
            const template_id = $('#template_id').val();
            if (!template_id || template_id == '') return;
            if (!confirm('Do you really want to delete this template?')) return;
            const base_url = '<?php echo base_url() ?>';
            document.body.style.cursor = 'wait';
            $.get(`${base_url}/report/deletetemplate/${template_id}`, (data, status) => {
                if (status === 'success') {
                    alert('Successfully deleted.');
                    const select = document.getElementById('template_id');
                    select.querySelectorAll('option')[select.selectedIndex].remove();
                    const iframe = document.getElementById('iframe');
                    const doc = iframe.contentDocument || iframe.contentWindow.document;
                    doc.open();
                    doc.write('');
                    doc.close();
                    document.getElementById('parameterPanel').innerHTML = '';
                    select.selectedIndex = 0;
                } else {
                    alert('Failed to delete template.');
                }
                document.body.style.cursor = 'initial';
            });
        });
        $('#saveaspdf').click(() => {
            const select = document.getElementById('template_id');
            const template_id = select.value;
            const base_url = '<?php echo base_url() ?>';
            if (select.selectedIndex === 0) return;
            const template_name = select.querySelectorAll('option')[select.selectedIndex].innerText;
            document.body.style.cursor = 'wait';
            const inputs = document.querySelectorAll('#parameterPanel input');
            const postData = {};
            for (const input of inputs) {
                postData[input.name] = input.value;
            };
            const tables = document.querySelectorAll('#tables table');
            for (const table of tables) {
                const fields = [];
                table.querySelectorAll('th').forEach((th) => { fields.push(th.innerText); });
                fields.shift();
                const selectedValue = parseInt(table.querySelector('input[type="radio"]:checked')?.value);
                if (!(selectedValue >= 0)) {
                    alert('Please select items.');
                    document.body.style.cursor = 'initial';
                    return;
                }
                const values = [];
                table.querySelectorAll('tbody tr')[selectedValue].querySelectorAll('td').forEach((item) => { values.push(item.innerText) });
                values.shift();
                for (let i = 0; i < fields.length; i++) {
                    const param = paramDict.filter(item => item.field === fields[i])[0].name;
                    postData[param] = values[i];
                }
            }
            const iframe = document.getElementById('iframe');
            const doc = iframe.contentDocument || iframe.contentWindow.document;
            document.body.style.cursor = 'wait';
            doc.open();
            doc.write('<style>body{cursor:wait}</style>');
            doc.close();
            $.post(`${base_url}/report/setreportwithparams/${template_id}`, postData, (data, status) => {
                if (status == 'success') {
                    doc.open();
                    doc.write(data);
                    doc.close();
                    const height = doc.body.querySelector('table').offsetHeight;
                    const width = doc.body.querySelector('table').offsetWidth;
                    html2pdf(data, {
                        margin: 0,
                        filename: `${template_name}.pdf`,
                        html2canvas: { scale: 10 },
                        jsPDF: { unit: 'px', format: [width, height], orientation: (width > height) ? 'landscape' : 'portrait' }
                    });
                    document.body.style.cursor = 'initial';
                    
                } else {
                    alert('Faild to save report as PDF.');
                    document.body.style.cursor = 'initial';
                }
            });
        });
    });
</script>