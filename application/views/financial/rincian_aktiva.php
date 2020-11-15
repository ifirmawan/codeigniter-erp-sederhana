<?php foreach ($item as $key => $row) { ?>
<!-- edit item -->
<form action="<?php echo base_url(). 'members/simpan_aktiva/'.$row->id_item; ?>" method="post"> 

    <div class="row fin-row">
      <div class="col-xs-12 col-md-8">
        <h3 class="f3" style="float: left;margin-right: 15px;">
          <small>No. Requestion</small><br/>
          <?php echo $row->no_permintaan; ?>
        </h3>
        <h3 class="f3" style="float: left;margin-right: 15px;">
          <small>Requestion Date</small><br/>
          <?php echo $row->tgl_permintaan; ?>
        </h3>
      </div>
      <div class="col-xs-12 col-md-4">
        <div style="text-align: right;">
          <button class="c-btn c-btn--primary" name="btn_function" value="simpan">
            <i class="fa fa-paper-plane"></i>&nbsp;Simpan
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
      <input class="c-input" disabled="" value="<?php echo $row->username; ;?>">
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
      <i class="fa fa-list">&nbsp; RINCIAN AKTIFA</i>
    </h3>
  </div>
</div>

<div class="row fin-row c-label-content" style="margin-left: 22px;">
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Jenis</label>
    </div>
    <div class="col-md-8">
      <input class="c-input" type="text" name="nama_item" value="<?php echo $row->nama_item;?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Type</label>
    </div>
    <div class="col-md-8">
      <input class="c-input"  type="text" name="description" value="<?php echo $row->description; ?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Jumlah</label>
    </div>
    <div class="col-md-4">
      <input class="c-input" type="number" name="jumlah" value="<?php echo $row->jumlah;?>">
    </div>
    <div class="col-md-4">
      <select name="satuan" class="c-input">

      <?php foreach ($satuan as $key => $value) { ?>  
        <option <?php echo ($row->satuan == $value)? "selected" : ""; ?> value="<?php echo $value; ?>">
          <?php echo $value; ?>
        </option>
      <?php } ?>      
    </select>
    </div>
  </div> 
  <div class="row fin-row">
    <div class="col-md-2" style="text-align: right;">
      <label class="c-label">Kebutuhan Aktiva Tetap</label>
    </div>
    <div class="col-md-8">
      <select id="select_keb" name="aktiva_tetap_enum" class="c-input"> 
          <option value="0">Pilih Kebutuhan aktiva tetap</option> 
      <?php
      
      foreach ($aktiva_tetap_enum as $key => $value) {
      ?>
      <option <?php echo ($row->aktiva_tetap_enum == $value)? "selected" : ""; ?> value="<?php echo $value; ?>">
        <?php echo $value; ?></option>
      <?php
      
    }
    ?>
      <option id="keb_lainya" value="lainya"><?php echo ucfirst("lainya..."); ?></option>
    </select>
      <input id="kebutuhan" type="text" name="aktiva_tetap_text" class="c-input" placeholder="Tulis kebutuhan aktiva" value="<?php echo $row->aktiva_tetap_text; ?>">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-md-2" style="text-align: right;">
      <label class="c-label">Golongan Aktiva</label>
    </div>
    <div class="col-md-8">
      <select id="select_gol" name="golongan_aktiva_enum" class="c-input">
          <option value="0">Pilih golongan aktiva</option>    
      <?php foreach ($golongan_aktiva_enum as $key => $value) { ?>
          <option <?php echo ( $row->golongan_aktiva_enum == $value)? "selected" : ""; ?> 
            value="<?php echo $value; ?>" >
            <?php echo $value; ?>
        
          </option>
      <?php } ?>
      <option id="gol_lainya" value="lainya"><?php echo ucfirst("lainya..."); ?></option>
    </select>
      <input id="golongan" type="text" name="golongan_aktiva_text" class="c-input" placeholder="Tulis golongan aktiva" value="<?php echo $row->golongan_aktiva_text; ?>">
    </div>
  </div>

  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Untuk Lokasi</label>
    </div>
    <div class="col-md-8">
      <input type="text" class="c-input " name="untuk_lokasi" placeholder="Bagian yang membutuhkan">
    </div>
  </div>

  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Estimasi Biaya</label>
    </div>
    <div class="col-md-8">
      <input type="number" class="c-input " name="estimasi_biaya" placeholder="Biaya yang dibutuhkan">
    </div>
  </div>

</div>

<div class="row fin-row c-label-head" style="margin-top: 10px; margin-left: 22px;">
  <div class=" col-xs-12 col-md-12">
    <h3>
      <i class="fa fa-exclamation-triangle">&nbsp; Catatan</i>
    </h3>
  </div>
</div>

<div class="row fin-row c-label-content" style="margin-left: 22px;">
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Alasan Perubahan Aktifa tetap</label>
    </div>
    <div class="col-md-8">
      <input class="c-input"  type="" name="alasan" placeholder="Alasan pengajuan">
    </div>
  </div>
  <div class="row fin-row">
    <div class="col-xs-12 col-md-2" style="text-align: right;">
      <label class="c-label">Catatan / Fakta Lain</label>
    </div>
    <div class="col-md-8">
      <textarea name="catatan" class="c-input" placeholder="*Jika ada catatan lainya"></textarea>
    </div>
  </div>
</div>
</form>
<!-- end edit item -->
</form>
<?php } ?>