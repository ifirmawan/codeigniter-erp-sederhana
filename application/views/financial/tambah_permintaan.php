<form action="<?php echo base_url(). 'members/post_permintaan' ?>" method="post"> 
    <!-- form input permintaan financial -->
<?php
if (is_null($permintaan)) {
  $judul_perm = "";
  $kep_perm = "";
}else{
  $judul_perm = $this->session->userdata['permintaan']['judul_permintaan'];
  $kep_perm = $this->session->userdata['permintaan']['keperluan'];
  $id_perm = $this->session->userdata['permintaan']['id_permintaan'];
}
?>  
    <div class="row fin-row">
      <div class="col-xs-12 col-md-8">
        
          <label class="c-label">
    Judul permintaan
    <input name="judul_permintaan" class="c-input" placeholder="pengajuan komputer" value="<?php echo ucfirst($judul_perm); ?>" />
  </label>
      </div>

      <div class="col-xs-12 col-md-4" <?php echo $control; ?>>
        <div style="text-align: right;">
          <button class="c-btn c-btn--tertiary" style="outline: none;" name="btn_function" value="Batal">
            <i class="fa fa-remove"></i>
            Batal
          </button>
          <button class="c-btn c-btn--primary" name="btn_function" value="Kirim">
            <i class="fa fa-send"></i>
            Kirim
          </button>
        </div>
      </div>
    </div>


  
<div class="row fin-row">
<div class="col-xs-12">
  Keperluan
  <textarea class="c-input" name="keperluan" placeholder="Edit me, yo"><?php echo ucfirst($kep_perm); ?></textarea>
</div>

</div>

</form> <!-- akhiri form -->

<div class="row fin-row" >
      <div class="col-xs-12">
        <hr class="c-rule" style="margin-top: 10px;" />
      </div>
</div>
<div class="row fin-row" <?php echo $table_hide; ?> >
      <div class="col-xs-12 col-md-8">
          <h3 class="f3" style="float: left;margin-right: 15px;">
    <small>No. Requestion</small><br/>
    <?php echo $no_permintaan; ?> <!-- menampilkan no permintaan -->
  </h3>
  <h3 class="f3" style="float: left;margin-right: 15px;">
    <small>Requestion Date</small><br/>
    <?php echo date('l jS \of F Y h:i:s A'); ?>
  </h3>
        </div>
        <div class="col-xs-12 col-md-4">
        <div style="text-align: right;">
          <button id="hapus_semua" value="<?php echo $id_perm ?>" href="<?php echo base_url(). 'members/hapus_semua/'.$id_perm; ?>" class="c-btn c-btn--red-outline">
            <i class="fa fa-trash"></i>
            Hapus Semua
          </button>
          
          <button class="c-btn c-btn--primary" onclick="window.location='<?php echo base_url().'members/selesai' ?>'  ">
            <i class="fa fa-check"></i>
            Selesai
          </button>
        </div>
      </div>
</div>
    <div class="row fin-row" >
      <div class="col-xs-12">

<?php if (isset($alert)) { ?>
      
<div class="c-banner c-banner--warning">
  <i class="fa fa-exclamation-triangle"></i><?php echo $alert; ?>
</div>
<?php } ?>

<div <?php echo $table_hide; ?> >
<table class="c-table c-table--zebra">
  <thead>
    <th>#</th>
    <!--<th>Type</th>-->
    <th>Name</th>
    <th>Amount</th>
    <th>Satuan</th>
    <th>Description</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
    $no='1';
      foreach ($item as $row) {
    ?>
    <tr>
      <td><?php echo $no; ?></td>
      <!--<td><?php //echo $row->jenis_pengajuan; ?></td>-->
      <td><?php echo ucfirst($row->nama_item); ?></td>
      <td><?php echo ucfirst($row->jumlah); ?></td>
      <td><?php echo ucfirst($row->satuan); ?></td>
      <td><?php echo ucfirst($row->description); ?> </td>
      <td><button type="submit" class="c-btn c-btn--red-outline" onclick="window.location='<?php echo base_url(). 'members/hapus_item/' .$row->id_item;  ?>'  "><i class="fa fa-trash"></i> Hapus</button>
        <button type="submit" name="edit" value="<?php echo $row->id_item; ?>" class="c-btn c-btn--primary" onclick="window.location='<?php echo base_url(). 'members/edit_item/' .$row->id_item.'/'.$row->satuan; ; ?>' "><i class="fa fa-edit"></i>&nbsp; Edit</button>
      </td>
    </tr>
    <?php
    $no++;
  }
  ?>

    <form action="<?php echo base_url(). 'members/post_item'; ?>" method="post">
    <tr>
      <td><i class="fa fa-plus"></i></td>
      <!--
      <td>  <select name="jenis_pengajuan">
          <option value="1" selected="true">Barang</option>
          <option value="2">Dana</option>
        </select></td>-->
      <td><input type="text" name="nama_item" placeholder="Nama item" class="c-input"></td>
      <td><input type="number" name="jumlah" placeholder="Jumlah" class="c-input"></td>
      <td>  
        <div class="input-group">
          
          <select id="satuan" name="satuan" class="c-input">
            <option selected value=""><?php echo ucwords('pilih satuan');?></option>
            <?php if(isset($satuan)) :?>
              <?php

              foreach ($satuan as $key => $value) { ?>
                <option value="<?php echo $value;?>"><?php echo $value;?></option>
              <?php } ?>
          
            <?php else :?>
              
              <option value="1">Rp.</option>
              <option value="2">Unit</option>
              <option value="3">Pcs</option>
            
            <?php endif;?>
          </select>
          
        </div>
        </td>
      <td><textarea name="description" class="c-input" placeholder="Keterangan" class="c-input"></textarea></td>
      <td><button id="selanjutnya" type="submit" class="c-btn c-btn--tertiary" name="btn" value="selanjutnya">Selanjutnya &nbsp;<i class="fa fa-arrow-right"></i></button>
          <button id="tambah" type="submit" class="c-btn c-btn--primary" name="btn" value="tambah"><i class="fa fa-plus"></i>&nbsp;Tambah</button>
      </td>
    </tr>
    </form>

  </tbody>
</table>