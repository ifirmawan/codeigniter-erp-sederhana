<?php 
  foreach ($item as $key => $value) {
?>

    <!-- form input permintaan financial -->

    <div class="row fin-row">
      <div class="col-xs-12 col-md-8">
        <h3 class="f3" style="float: left;margin-right: 15px;">
          <small>No. Requestion</small><br/>
          <?php echo $value->no_permintaan; ?>
        </h3>
        <h3 class="f3" style="float: left;margin-right: 15px;">
          <small>Requestion Date</small><br/>
          <?php echo $value->tgl_permintaan; ?>
        </h3>
      </div>
<!-- Button untuk direksi -->
      <div id="btn_direksi" class="col-xs-12 col-md-4">
        <div style="text-align: right;">
          <?php if (isset($id_item)) { ?>
            <button id="btn_terima" class="c-btn c-btn--primary" name="btn_function" value="terima" onclick="window.location='<?php echo base_url(). 'direksi/terima_pengajuan/'.$id_item.'/'.$value->id_permintaan; ?>' ">Terima</button>
            
            <button value="" id="btn_tolak" class="c-btn c-btn--secondary" data-toggle="modal" data-target="#myModal">Tolak</button>
            <button value="" id="btn_revisi" class="c-btn c-btn--tertiary" data-toggle="modal" data-target="#myModal">Revisi</button>
            
          <?php } ?>
        </div>
      </div>
<!-- end -->
<form action="<?php echo base_url(). 'members/detail_permintaan/'.$value->id_permintaan; ?>" method="post"> 
      <div id="btn_kembali" class="col-xs-12 col-md-4" <?php if (isset($hide)) {
        echo $hide;
      } ?> >
        <div style="text-align: right;">
          <button class="c-btn c-btn--tertiary" style="outline: none;" name="btn_function" value="Batal">
            <i class="fa fa-remove"></i>
            Kembali
          </button>
        </div>
      </div>
    </div>
  <div class="row fin-row c-label-head" style="margin-left: 22px; margin-top: 10px;">
   <div class="col-xs-12">
     <h3>
       <i class="fa fa-user"> &nbsp;PEMOHON</i>
     </h3>
   </div> 
  </div>

<div class="row fin-row c-label-content" style="margin-left: 22px;">
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Nama</label>
    </div>
    <div class="col-md-8" >
      <input class="c-input" disabled="" value="<?php echo ucwords($value->username); ;?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Jabatan</label>
    </div>
    <div class="col-md-8" >
      <input class="c-input" disabled="" value="<?php echo "Jabatan" ;?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Departement</label>
    </div>
    <div class="col-md-8" >
      <input class="c-input" disabled="" value="<?php echo "Departement" ;?>">
    </div>
  </div>
</div>

<div class="row fin-row c-label-head" style="margin-top: 10px; margin-left: 22px;">
  <div class="col-xs-12 col-md-12">
    <h3>
      <i class="fa fa-list">&nbsp; RINCIAN AKTIVA</i>
    </h3>
  </div>
</div>

<div class="row fin-row c-label-content" style="margin-left: 22px;">
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Jenis</label>
    </div>
    <div class="col-md-8">
      <input class="c-input" disabled="" type="" name="" value="<?php echo ucwords($value->nama_item).' '.$value->jumlah.' '.$value->satuan ; ?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Type</label>
    </div>
    <div class="col-md-8">
      <input class="c-input" disabled="" type="" name="" value="<?php echo ucfirst($value->description); ?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-md-2" style="text-align: right;">
      <label class="c-label">Kebutuhan Aktiva Tetap</label>
    </div>
    <div class="col-md-8">
      <input class="c-input" disabled="" type="" name="" value="<?php echo ($value->aktiva_tetap_enum=="")? $value->aktiva_tetap_text : $value->aktiva_tetap_enum ; ?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-md-2" style="text-align: right;">
      <label class="c-label">Golongan Aktiva</label>
    </div>
    <div class="col-md-8">
      <input disabled="" class="c-input " name="" value="<?php echo ($value->golongan_aktiva_enum=="")? $value->golongan_aktiva_text : $value->golongan_aktiva_enum ; ?>">
    </div>
  </div>

  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Untuk Lokasi</label>
    </div>
    <div class="col-md-8">
      <input disabled="" class="c-input " name="" value="<?php echo ucwords($value->untuk_lokasi); ?>">
    </div>
  </div>

  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Estimasi Biaya</label>
    </div>
    <div class="col-md-8">
      <input disabled="" class="c-input " name="" value="<?php echo show_currency_format($value->estimasi_biaya); ?>">
    </div>
  </div>

</div>

<div class="row fin-row c-label-head" style="margin-top: 10px; margin-left: 22px;">
  <div class=" col-xs-12 col-md-12">
    <h3>
      <i class="fa fa-exclamation-triangle">&nbsp; CATATAN</i>
    </h3>
  </div>
</div>

<div class="row fin-row c-label-content" style="margin-left: 22px;">
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Alasan Perubahan Aktiva tetap</label>
    </div>
    <div class="col-md-8">
      <input class="c-input" disabled="" type="" name="" value="<?php echo ucfirst($value->alasan); ?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Catatan</label>
    </div>
    <div class="col-md-8">
      <textarea disabled="" class="c-input" placeholder="Tidak ada catatan"><?php echo ucfirst($value->catatan); ?></textarea>
    </div>
  </div>
</div>
</form>
 
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <form action="<?php echo base_url(). 'direksi/tanggapi_pengajuan/'.$value->id_item; ?>" method="post">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      
        <div class="modal-body">
           <input type="hidden" name="id_permintaan" value="<?php echo $value->id_permintaan; ?>">
            <textarea class="c-input" name="catatan" placeholder="Masukan alasan anda"></textarea>
        </div>
        <div class="modal-footer">
          <button id="revisi" type="submit" class="btn btn-primary" name="btn_function" value="revisi">Simpan</button>
          <button id="tolak" type="submit" class="btn btn-primary"  name="btn_function" value="tolak">Simpan</button>
        </div>
      </form>
    </div>

  </div>
</div>
<?php } ?>

