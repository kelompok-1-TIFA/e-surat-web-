<?php $this->load->view('inc/head'); ?>
<?php $this->load->view('inc/sidebar'); ?>
<?php $this->load->view('inc/navbar'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">mail</i>
                            </div>
                            <h4 class="card-title">Data <?php echo $page_title; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-3">
                                        <div class="form-group">
                                            <select class="selectpicker" name="id_jenis_surat" data-style="btn select-with-transition" title="Pilih Tahunan" data-size="7">
                                                <?php foreach ($data_jenis_surat as $jenis_surat): ?>
                                                    <option value="<?php echo $jenis_surat->id_jenis_surat ?>"> <?php echo $jenis_surat->jenis_surat; ?></option>
                                                <?php endforeach ?>
                                          </select>
                                        </div>
                                    </div>
                            <div class="material-datatables">
                                <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>No Surat</th>
                                            <th>Tujuan</th>
                                            <th>Perihal</th>
                                            <th>Tanggal Arsip</th>
                                            <th>File</th>
                                            <th class="disabled-sorting text-right">Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div><!-- end content-->
                    </div><!--  end card  -->
                </div> <!-- end col-md-12 -->
            </div>
        </div>
    </div>
<?php $this->load->view('inc/footer'); ?>      
<?php $this->load->view('inc/js'); ?>
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/    -->
<script src="<?php echo base_url() ?>assets/js/plugins/jquery.datatables.js"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('#datatables').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        responsive: true,
        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search records",
        }

    });


    var table = $('#datatables').DataTable();
        $('.card .material-datatables label').addClass('form-group');
    });

</script>
<script type="text/javascript">
    $( document ).ready(function() {
        <?php echo $this->session->flashdata('sukses'); ?>
        <?php echo $this->session->flashdata('alert'); ?>
        <?php echo $this->session->flashdata('message'); ?>
    });

    function deletedata(id,datanya){
        swal({
            title: "Anda Yakin?",
            text: "Data "+datanya+" Akan Dihapus Secara Permanen!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'btn btn-success',
            cancelButtonClass: 'btn btn-danger',
            confirmButtonText: 'Yes, delete it!',
            buttonsStyling: false
        }).then(function(){
            $.ajax({
                url: "<?php echo base_url('surat_keluar/hapus') ?>",
                type: "post",
                data: {id:id},
                success:function(){
                    swal({
                        title: 'Berhasil!',
                        text: 'Data Berhasil Di Hapus.',
                        type: 'success',
                        confirmButtonClass: "btn btn-success",
                        buttonsStyling: false
                    })
                    $("#datanya").fadeTo("slow", 0.7, function(){
                        $(this).remove();
                    })
                },error:function(){
                    swal({
                        title: 'Gagal!',
                        text: 'Data Gagal Di Hapus.',
                        type: 'error',
                        confirmButtonClass: "btn btn-danger",
                        buttonsStyling: false
                    })
                }
            });
        }).catch(swal.noop)
    }
</script>
</html>