<?php
$currency_symbol = $this->customlib->getSchoolCurrencyFormat();
?>
<style>
    #startItem, #endItem, #totalItem {
        margin-left: 2px;
        margin-right: 2px;
    }
</style>
<div class="content-wrapper">
    <section class="content-header">
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-search"></i> <?php echo $this->lang->line('select_criteria'); ?></h3>
                    </div>
                    <div class="box-body">
                       
                        <?php if ($this->session->flashdata('msg')) {?> <div class="alert alert-success">  <?php echo $this->session->flashdata('msg'); $this->session->unset_userdata('msg'); ?> </div> <?php }?>
                        <div class="row">
                              <form role="form" action="<?php echo site_url('student/searchvalidation') ?>" method="post" class="class_search_form">
                            <div class="col-md-6">
                                <div class="row">
                                    <?php echo $this->customlib->getCSRF(); ?>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('class'); ?></label> <small class="req"> *</small>
                                            <select autofocus="" id="class_id" name="class_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                                <?php
                                                    $count = 0;
                                                    foreach ($classlist as $class) {
                                                        ?>
                                                        <option value="<?php echo $class['id'] ?>" <?php if (set_value('class_id') == $class['id']) {
                                                            echo "selected=selected";
                                                        }
                                                        ?>><?php echo $class['class'] ?></option>
                                                                                                            <?php
                                                        $count++;
                                                    }
                                                ?>
                                            </select>
                                                <span class="text-danger" id="error_class_id"></span>
                                        </div>
                                    </div> 
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('section'); ?></label>
                                            <select  id="section_id" name="section_id" class="form-control" >
                                                <option value=""><?php echo $this->lang->line('select'); ?></option>
                                            </select>
                                            <span class="text-danger"><?php echo form_error('section_id'); ?></span>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="button" name="managing_params" value="managing_params" class="btn btn-primary pull-left btn-sm checkbox-toggle"><i class="fa fa-shopping-bag"></i> Managing Parameters</button>
                                            <button type="submit" name="search" value="search_filter" class="btn btn-primary btn-sm pull-right checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--./col-md-6-->
                               
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php echo $this->lang->line('search_by_keyword'); ?></label>
                                    <input type="text" name="search_text" id="search_text" class="form-control" value="<?php echo set_value('search_text'); ?>"   placeholder="<?php echo $this->lang->line('search_by_student_name'); ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="button" name="export_report" value="export_report" class="btn btn-primary pull-left btn-sm checkbox-toggle"><i class="fa fa-share-square"></i> Make a report</button>
                                            <button type="submit" name="search" value="search_full" class="btn btn-primary pull-right btn-sm checkbox-toggle"><i class="fa fa-search"></i> <?php echo $this->lang->line('search'); ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!--./col-md-6-->
                       </form>
                        </div><!--./row-->
                    </div>
                
                    <div class="nav-tabs-custom border0 navnoshadow">
                      <div class="box-header ptbnull"></div>
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i> <?php echo $this->lang->line('list_view'); ?></a></li>
                            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-newspaper-o"></i> <?php echo $this->lang->line('details_view'); ?></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active table-responsive no-padding overflow-visible-lg" id="tab_1">
                                <div style="display: flex;">
                                    <div style="display: flex;">
                                        <button class="btn btn-sm btn-primary" id="btnSelectAll" style="border:0">Unselect All</button>
                                    </div>
                                    <div style="display: flex; margin-left: auto; margin-right: 0;">
                                        <input type="text" id="filterTable" class="form-control" placeholder="Search table ...">
                                    </div>
                                </div>
                                <table class="table table-striped table-bordered table-hover student-list text-center" data-export-title="<?php echo $this->lang->line('student_list'); ?>">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php echo $this->lang->line('admission_no'); ?></th>
                                            <th><?php echo $this->lang->line('student_name'); ?></th>
                                            <th><?php echo $this->lang->line('roll_no'); ?></th>
                                            <th><?php echo $this->lang->line('class'); ?></th>
                                             <?php if ($sch_setting->father_name) {?>
                                            <th><?php echo $this->lang->line('father_name'); ?></th>
                                            <?php }?>
                                            <th><?php echo $this->lang->line('date_of_birth'); ?></th>
                                            <th><?php echo $this->lang->line('gender'); ?></th>
                                            <?php if ($sch_setting->category) {
                                            ?>
                                            <?php if ($sch_setting->category) {?>
                                            <th><?php echo $this->lang->line('category'); ?></th>
                                            <?php }
}if ($sch_setting->mobile_no) {
    ?>
                                            <th><?php echo $this->lang->line('mobile_number'); ?></th>
                                            <?php
}
if (!empty($fields)) {

    foreach ($fields as $fields_key => $fields_value) {
        ?>
                                                    <th><?php echo $fields_value->name; ?></th>
                                                    <?php
}
}
?>
                                            <th class="text-right noExport"><?php echo $this->lang->line('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="11" style="padding-top: 5rem; padding-bottom: 5rem; background: #ccc; color: #f66;">No students in table</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div style="display: flex">
                                    <div style="display: flex">
                                        <button id="nextPageBtn" class="btn btn-secondary btn-xs" onclick="prevPage()" disabled="true">&lt;</button>
                                    </div>
                                    <div style="display: flex; margin-left: 10px; margin-right: 10px;" id="pagination">
                                        <button class="btn btn-primary btn-xs" onclick="setPage(1)">1</button>
                                    </div>
                                    <div style="display: flex">
                                        <button id="prevPageBtn" class="btn btn-secondary btn-xs" onclick="nextPage()" disabled="true">&gt;</button>
                                    </div>
                                    <div style="display: flex; margin-left: 4rem;">
                                        Students <span id="startItem">0</span> to <span id="endItem">0</span> of <span id="totalItem">0</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane detail_view_tab" id="tab_2">
                                <?php if (empty($resultlist)) {
    ?>
                                    <div class="alert alert-info"><?php echo $this->lang->line('no_record_found'); ?></div>
                                    <?php
} else {
    $count = 1;
    foreach ($resultlist as $student) {

        if (empty($student["image"])) {
            if ($student['gender'] == 'Female') {
                $image = "uploads/student_images/default_female.jpg";
            } else {
                $image = "uploads/student_images/default_male.jpg";
            }
        } else {
            $image = $student['image'];
        }
        ?>
                                        <div class="carousel-row">
                                            <div class="slide-row">
                                                <div id="carousel-2" class="carousel slide slide-carousel" data-ride="carousel">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>">
                                                                <?php if ($sch_setting->student_photo) {?><img class="img-responsive img-thumbnail width150" alt="<?php echo $student["firstname"] . " " . $student["lastname"] ?>" src="<?php echo $this->media_storage->getImageURL($image); ?>" alt="Image"><?php }?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide-content">
                                                    <h4><a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>"> <?php echo $this->customlib->getFullName($student['firstname'], $student['middlename'], $student['lastname'], $sch_setting->middlename, $sch_setting->lastname); ?></a></h4>
                                                    <div class="row">
                                                        <div class="col-xs-6 col-md-6">
                                                            <address>
                                                                <strong><b><?php echo $this->lang->line('class'); ?>: </b><?php echo $student['class'] . "(" . $student['section'] . ")" ?></strong><br>
                                                                <b><?php echo $this->lang->line('admission_no'); ?>: </b><?php echo $student['admission_no'] ?><br/>
                                                                <b><?php echo $this->lang->line('date_of_birth'); ?>:
            <?php if ($student["dob"] != null && $student["dob"] != '0000-00-00') {echo date($this->customlib->getSchoolDateFormat(), $this->customlib->dateyyyymmddTodateformat($student['dob']));}?><br>
                                                                    <b><?php echo $this->lang->line('gender'); ?>:&nbsp;</b><?php echo $this->lang->line(strtolower($student['gender'])) ?><br>
                                                                    </address>
                                                                    </div>
                                                                    <div class="col-xs-6 col-md-6">
                                                                        <b><?php echo $this->lang->line('local_identification_no'); ?>:&nbsp;</b><?php echo $student['samagra_id'] ?><br>
                                                                        <?php if ($sch_setting->guardian_name) {?>
                                                                        <b><?php echo $this->lang->line('guardian_name'); ?>:&nbsp;</b><?php echo $student['guardian_name'] ?><br>
                                                                    <?php }if ($sch_setting->guardian_name) {?>
                                                                        <b><?php echo $this->lang->line('guardian_phone'); ?>: </b> <abbr title="Phone"><i class="fa fa-phone-square"></i>&nbsp;</abbr> <?php echo $student['guardian_phone'] ?><br> <?php }?>
                                                                        <b><?php echo $this->lang->line('current_address'); ?>:&nbsp;</b><?php echo $student['current_address'] ?> <?php echo $student['city'] ?><br>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <div class="slide-footer">
                                                                        <span class="pull-right buttons">
                                                                            <a href="<?php echo base_url(); ?>student/view/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('view'); ?>" >
                                                                                <i class="fa fa-reorder"></i>
                                                                            </a>
                                                                            <?php
if ($this->rbac->hasPrivilege('student', 'can_edit')) {
            ?>
                                                                                <a href="<?php echo base_url(); ?>student/edit/<?php echo $student['id'] ?>" class="btn btn-default btn-xs"  data-toggle="tooltip" title="<?php echo $this->lang->line('edit'); ?>">
                                                                                    <i class="fa fa-pencil"></i>
                                                                                </a>
                                                                                <?php
}
        if ($this->module_lib->hasActive('fees_collection') && $this->rbac->hasPrivilege('collect_fees', 'can_add')) {
            ?>
                                                                                <a href="<?php echo base_url(); ?>studentfee/addfee/<?php echo $student['id'] ?>" class="btn btn-default btn-xs" data-toggle="tooltip" title="" data-original-title="<?php echo $this->lang->line('add_fees'); ?>">
                                                                                <?php echo $currency_symbol; ?>
                                                                                </a>
            <?php }?>
                                                                        </span>
                                                                    </div>
                                                                    </div>
                                                                    </div>
                                                                    <?php
}
    $count++;
}
?>
                                                            </div>
                                                            </div>
                                                            </div>
                                                          </div><!--./box box-primary -->
                                                           
                                                        </div>
                                                        </div>
    </section>
    <div class="modal fade" id="managingParams" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content modal-media-content">
                <div class="modal-header modal-media-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="box-title">Manage parameters</h4>
                </div>
                <div class="modal-body pt0 pb0" id="getdetails">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="community">الجماعة</label>
                                <small class="req"> *</small>
                                <input type="text" class="form-control" autocomplete="off" id="community" value="<?php echo $params->community;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="delegation">المديرية</label>
                                <small class="req"> *</small>
                                <input type="text" class="form-control" autocomplete="off" id="delegation" value="<?php echo $params->delegation;?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nameAcademy">الأكاديمية</label>
                                <small class="req"> *</small>
                                <input type="text" class="form-control" autocomplete="off" id="nameAcademy" value="<?php echo $params->name_academy;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="year_s">السنة الدراسية</label>
                                <small class="req"> *</small>
                                <input type="text" class="form-control" autocomplete="off" id="year_s" value="<?php echo $params->year_s;?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="reportTitle">عنوان</label>
                                <small class="req"> *</small>
                                <input type="text" class="form-control" autocomplete="off" id="reportTitle" value="<?php echo $params->title;?>">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="nameDelegation">المؤسسة</label>
                                <small class="req"> *</small>
                                <input type="text" class="form-control" autocomplete="off" id="nameDelegation" value="<?php echo $params->name_delegation;?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" role="save" class="btn btn-primary pull-left btn-sm checkbox-toggle"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

function getSectionByClass(class_id, section_id) {
    if (class_id != "" && section_id != "") {
        $('#section_id').html("");
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    var sel = "";
                    if (section_id == obj.section_id) {
                        sel = "selected";
                    }
                    div_data += "<option value=" + obj.section_id + " " + sel + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    }
}

$(document).ready(function () {
    $('#managingParams').modal({
        backdrop: 'static',
        keyboard: false,
        show: false,
    });
    var class_id = $('#class_id').val();
    var section_id = '<?php echo set_value('section_id') ?>';
    getSectionByClass(class_id, section_id);
    $(document).on('change', '#class_id', function (e) {
        $('#section_id').html("");
        var class_id = $(this).val();
        var base_url = '<?php echo base_url() ?>';
        var div_data = '<option value=""><?php echo $this->lang->line('select'); ?></option>';
        $.ajax({
            type: "GET",
            url: base_url + "sections/getByClass",
            data: {'class_id': class_id},
            dataType: "json",
            success: function (data) {
                $.each(data, function (i, obj)
                {
                    div_data += "<option value=" + obj.section_id + ">" + obj.section + "</option>";
                });
                $('#section_id').append(div_data);
            }
        });
    });
});
let countStudents = 0;
let filteredCountStudents = 0;
let currentPage = 1;
let totalPage = 1;
const paginationBtn = (num = 1) => {
    if (num < 1) return '';
    if (num > totalPage) return '';
    return `<button class="btn btn-secondary btn-xs" onclick="setPage(${num})">${num}</button>`;
}
const setPage = (num = 1) => {
    let txt = '';
    if (num < 1 || num > totalPage) return;
    const nextPageBtn = document.getElementById('nextPageBtn');
    const prevPageBtn = document.getElementById('prevPageBtn');
    nextPageBtn.disabled = false;
    prevPageBtn.disabled = false;
    if (num === 1) {
        txt = '';
        for (let i = 1; i <= 6; i++) {
            txt += `${paginationBtn(i)}`;
        }
        nextPageBtn.disabled = true;
    }
    if (num === totalPage) {
        txt = '';
        for (let i = num - 5; i <= num; i++) {
            txt += `${paginationBtn(i)}`;
        }
        prevPageBtn.disabled = true;
    }
    if(num > 1 && num < totalPage) {
        txt = '';
        for (let i = num - 4; i <= num + 4; i++) {
            txt += `${paginationBtn(i)}`;
        }
    }
    currentPage = num;
    const trs = document.querySelectorAll('#tab_1 tbody > tr[search="1"]');
    for (let i = 0; i < trs.length; i++) {
        trs[i].style.display = 'none';
        if (i >= (currentPage - 1) * 50 && i < 50 * currentPage) trs[i].style.display = 'table-row';
    }
    document.getElementById('pagination').innerHTML = txt;
    document.getElementById('startItem').innerText = countStudents ? 50 * currentPage - 49 : 0;
    document.getElementById('endItem').innerText = (50 * currentPage <= filteredCountStudents) ? 50 * currentPage : filteredCountStudents;
    document.getElementById('totalItem').innerText = filteredCountStudents;
    const paginationBtns = document.querySelectorAll('#pagination button');
    paginationBtns.forEach(btn => {
        if (btn.innerText == currentPage) {
            btn.classList.remove('btn-secondary');
            btn.classList.add('btn-primary');
        } else {
            btn.classList.remove('btn-primary');
            btn.classList.add('btn-secondary');
        }
    });
}
const nextPage = () => {
    if (currentPage !== totalPage) setPage(currentPage + 1);
}
const prevPage = () => {
    if (currentPage !== 1) setPage(currentPage - 1);
}
</script>

<script type="text/javascript">
$(document).ready(function(){
const btnSelectAll = document.getElementById('btnSelectAll');
btnSelectAll.onclick = () => {
    const btnContent = btnSelectAll.innerText;
    const checkBoxes = document.querySelectorAll('#tab_1 tbody > tr > td:first-child input[type="checkbox"]');
    if (checkBoxes.length === 0) return;
    if (btnContent === 'Select All') {
        btnSelectAll.innerText = 'Unselect All';
        checkBoxes.forEach(box => box.checked = true);
    } else {
        btnSelectAll.innerText = 'Select All';
        checkBoxes.forEach(box => box.checked = false);

    }
};
const filterTableComp = document.getElementById('filterTable');
filterTableComp.oninput = (e) => {
    const trs = document.querySelectorAll('#tab_1 tbody > tr');
    setTimeout(() => {
        let count = 0;
        trs.forEach(tr => {
            const txt = tr.innerText.trim().toLowerCase();
            if (txt.indexOf(filterTableComp.value.toLowerCase()) >= 0) {
                if (count >= (currentPage - 1) * 50 && count < currentPage * 50) tr.style.display = 'table-row';
                else tr.style.display = 'none';
                count++;
                tr.setAttribute('search', '1');
            } else {
                tr.style.display = 'none';
                tr.setAttribute('search', '0');
            }
        });
        filteredCountStudents = count;
        totalPage = count ? Math.floor(count / 50) + 1 : 1;
        setPage(1);
    }, 10);
}
document.querySelector('button[name="export_report"]').addEventListener('click', () => {
    const className = document.querySelector('#class_id').value;
    const section = document.querySelector('#section_id').value;
    const searchText = document.querySelector('#search_text').value;
    const base_url = '<?php echo base_url() ?>';
    const inputs = document.querySelectorAll('#tab_1 tbody > tr > td:first-child input[type="checkbox"]:checked');
    const filter = [];
    inputs.forEach((input) => {filter.push(parseInt(input.value))});
    if (filter.length === 0) return;
    $.post({
        url: `${base_url}student/reportStudentList`,
        data: {
            class_id: className,
            section_id: section,
            search_text: searchText,
            filter: filter,
        },
        xhrFields: {
            responseType: 'blob'
        },
        success: (data) => {
            const link = document.createElement('a');
            link.href = URL.createObjectURL(data);
            link.download = 'list_student.pdf';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        },
        error: (data) => {
            console.log(data);
            alert('Oops! Something went wrong!');
        }
    });
});
document.querySelector('button[value="managing_params"]').addEventListener('click', () => {
    $('#managingParams').modal();
});
document.querySelector('#managingParams button[role="save"]').addEventListener('click', () => {
    const base_url = '<?php echo base_url() ?>';
    const community = document.querySelector('#community').value;
    const delegation = document.querySelector('#delegation').value;
    const nameAcademy = document.querySelector('#nameAcademy').value;
    const year_s = document.querySelector('#year_s').value;
    const nameDelegation = document.querySelector('#nameDelegation').value;
    const title = document.querySelector('#reportTitle').value;
    const postData = {
        community: community,
        delegation: delegation,
        nameAcademy: nameAcademy,
        year_s: year_s,
        nameDelegation: nameDelegation,
        title: title,
    }
    $.post(`${base_url}/student/manageReportParams`, postData, (data, status) => {
        if (status === 'success' && data === 'success') {
            alert('Parameters has been saved successfully.');
        } else {
            alert('Oops! Something went wrong.');
            console.error(data);
        }
    });
})

$("form.class_search_form button[type=submit]").click(function() {
    $("button[type=submit]", $(this).parents("form")).removeAttr("clicked");
    $(this).attr("clicked", "true");
});

$(document).on('submit','.class_search_form',function(e) {
    e.preventDefault(); // avoid to execute the actual submit of the form.
    var $this = $("button[type=submit][clicked=true]");
    var form = $(this);
    var url = form.attr('action');
    var form_data = form.serializeArray();
    form_data.push({name: 'search_type', value: $this.attr('value')});
    $.ajax({
        url: url,
        type: "POST",
        dataType:'JSON',
        data: form_data, // serializes the form's elements.
        beforeSend: function () {
            $('[id^=error]').html("");
            $this.button('loading');
            resetFields($this.attr('value'));
        },
        success: function(response) { // your success handler

        if(!response.status){
            $.each(response.error, function(key, value) {
                $('#error_' + key).html(value);
            });
        } else {
            $.post(`${base_url}student/dtstudentlist`, response.params, (data1, status) => {
                if (status === 'success') {
                    const data = JSON.parse(data1).data;
                    const tbody = document.querySelector('#tab_1 tbody');
                    tbody.innerHTML = '';
                    countStudents = data.length;
                    filteredCountStudents = countStudents;
                    totalPage = countStudents ? Math.floor(countStudents / 50) + 1 : 1;
                    let count = 0;
                    data.forEach(datum => {
                        tbody.innerHTML += `<tr${count < 50 ? '' : ' style="display: none"'} search="1">
                            <td>${datum[0]}</td>
                            <td>${datum[1]}</td>
                            <td>${datum[2]}</td>
                            <td>${datum[3]}</td>
                            <td>${datum[4]}</td>
                            <td>${datum[5]}</td>
                            <td>${datum[6]}</td>
                            <td>${datum[7] ? 'Woman' : 'Man'}</td>
                            <td>${datum[8]}</td>
                            <td>${datum[9]}</td>
                            <td>${datum[10]}</td>
                        </tr>`;
                        count++;
                    });
                    document.getElementById('totalItem').innerText = countStudents;
                    setPage(1);
                } else {
                    console.error(status, data1);
                }
            })

        if ($.fn.DataTable.isDataTable('.student-list')) { // if exist datatable it will destrory first
         $('.student-list').DataTable().destroy();
       }
//         table= $('.student-list').DataTable({
//         searching: false,
//         dom: 'Bfrtip',
//           buttons: [
//             {
//                 extend:    'copy',
//                 text:      '<i class="fa fa-files-o"></i>',
//                 titleAttr: 'Copy',
//                  className: "btn-copy",
//                 title: $('.student-list').data("exportTitle"),
//                   exportOptions: {
//                     columns: ["thead th:not(.noExport)"]
//                   }
//             },
//             {
//                 extend:    'excel',
//                 text:      '<i class="fa fa-file-excel-o"></i>',
//                 titleAttr: 'Excel',
//                      className: "btn-excel",
//                 title: $('.student-list').data("exportTitle"),
//                   exportOptions: {
//                     columns: ["thead th:not(.noExport)"]
//                   }
//             },
//             {
//                 extend:    'csv',
//                 text:      '<i class="fa fa-file-text-o"></i>',
//                 titleAttr: 'CSV',
//                 className: "btn-csv",
//                 title: $('.student-list').data("exportTitle"),
//                   exportOptions: {
//                     columns: ["thead th:not(.noExport)"]
//                   }
//             },
//             {
//                 extend:    'pdf',
//                 text:      '<i class="fa fa-file-pdf-o"></i>',
//                 titleAttr: 'PDF',
//                 className: "btn-pdf",
//                 title: $('.student-list').data("exportTitle"),
//                   exportOptions: {
//                     columns: ["thead th:not(.noExport)"]
//                   },

//             },
//             {
//                 extend:    'print',
//                 text:      '<i class="fa fa-print"></i>',
//                 titleAttr: 'Print',
//                 className: "btn-print",
//                 title: $('.student-list').data("exportTitle"),
//                 customize: function ( win ) {

//                     $(win.document.body).find('th').addClass('display').css('text-align', 'center');
//                     $(win.document.body).find('table').addClass('display').css('font-size', '14px');     
//                     $(win.document.body).find('h1').css('text-align', 'center');
//                 },
//                 exportOptions: {
//                     columns: ["thead th:not(.noExport)"]

//                   }

//             }
//         ],

//         "columnDefs": [ {
//         "targets": -1,
//         "orderable": true,
//         } ],
//         "language": {
//             processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i><span class="sr-only">Loading...</span> '
//         },
//         "pageLength": 1000,
//         "processing": true,
//         "serverSide": true,
//         "ajax":{
//         "url": baseurl+"student/dtstudentlist",
//         "dataSrc": 'data',
//         "type": "POST",
//         'data': response.params,

//      },"drawCallback": function(settings) {

//     $('.detail_view_tab').html("").html(settings.json.student_detail_view);
// }

//     });
//             //=======================
                }
              },
             error: function() { // your error handler
                 $this.button('reset');
             },
             complete: function() {
             $this.button('reset');
             }
        });
         
        document.body.style.cursor = 'initial';

});

    });
    function resetFields(search_type){

        if(search_type == "search_full"){
            $('#class_id').prop('selectedIndex',0);
            $('#section_id').find('option').not(':first').remove();
        }else if (search_type == "search_filter") {

             $('#search_text').val("");
        }
    }
</script>