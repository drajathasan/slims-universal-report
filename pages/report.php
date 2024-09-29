<?php
/**
 * @author Drajat Hasan
 * @email <drajathasan20@gmail.com>
 * @create date 2024-09-29 14:29:50
 * @modify date 2024-09-29 15:29:22
 * @license GPLv3
 * @desc [description]
 */

 // start the session
require SB.'admin/default/session.inc.php';
require SB.'admin/default/session_check.inc.php';
// privileges checking
$can_read = utility::havePrivilege('circulation', 'r') || utility::havePrivilege('reporting', 'r');
$can_write = utility::havePrivilege('circulation', 'w') || utility::havePrivilege('reporting', 'w');

if (!$can_read) {
    die('<div class="errorBox">'.__('You don\'t have enough privileges to access this area!').'</div>');
}

require SIMBIO.'simbio_GUI/table/simbio_table.inc.php';
require SIMBIO.'simbio_GUI/form_maker/simbio_form_element.inc.php';
require SIMBIO.'simbio_GUI/paging/simbio_paging.inc.php';
require SIMBIO.'simbio_DB/datagrid/simbio_dbgrid.inc.php';
require MDLBS.'reporting/report_dbgrid.inc.php';
require __DIR__ . '/../lib/Schema.php';

$tableList = implode('', array_map(function($table) {
    return '<option value="' . $table . '">' . ucwords(str_replace('_', ' ', $table)) . '</option>';
}, iterator_to_array(Schema::getTables())));
?>
<div class="menuBox">
    <div class="menuBoxInner biblioIcon">
        <div class="per_title">
            <h2>Universal Report</h2>
        </div>
        <div class="sub_section">
            <div class="d-flex flex-column my-2">
                <label>Tabel Utama</label>
                <select class="select2" style="width: fit-content">
                    <option>Pilih</option>
                    <?= $tableList ?>
                </select>
            </div>
            <div class="d-flex flex-column">
                <label>Berelasi Dengan</label>
                <div id="join_relation" class="d-flex flex-wrap" style="gap: 10px">
                    <div class="d-flex flex-column">
                        <label>Tabel <span></span></label>
                        <select class="select2" style="width: fit-content">
                            <option>Pilih</option>
                            <?= $tableList ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>