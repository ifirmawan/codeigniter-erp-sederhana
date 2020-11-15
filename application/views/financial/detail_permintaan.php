<div class="row fin-row">
  <div class="col-xs-12 col-md-8">
    <?php
    foreach ($permintaan as $row) {
    ?>
    <h3 class="f3"><?php echo ucwords($row->judul_permintaan); ?>
      <br/>
      <?php foreach ($oleh as $dari) { ?>
      <small>Diajukan pada <?php echo $row->tgl_permintaan; ?> . Oleh : <a href="<?php echo base_url().'members/detail_user/'.$dari->id;?>">
        <?php echo $dari->username; ?>
      </a></small>
      <?php } ?>
    </h3>
  </div>  
  <div class="col-xs-12 col-md-4">
    <div style="text-align: right;">
      <button onclick="window.location='<?php echo base_url(). 'members/back' ?>'" class="c-btn c-btn--tertiary" style="outline: none;">
        <i class="fa fa-arrow-left"></i>
        Kembali
      </button>
      <button class="c-btn c-btn--secondary">
        <i class="fa fa-print"></i>
        Cetak
      </button>

      <button id="btn_review" class="c-btn c-btn--primary" onclick="window.location='<?php echo base_url(). 'members/edit/' .$row->id_permintaan; ?>'">
          <i class="fa fa-pencil"></i>
          Review
      </button>
      <input id="dept" type="hidden" name="dept" value="<?php echo isset($dept)? $dept : "" ?>">

    </div>
  </div>
</div>
    <div class="row fin-row" >
      <div class="col-xs-12">
        
<div class="o-media">
  <img class="o-media__img" src="http://i.imgur.com/GoCxCU3.jpg" width="64" alt="Aaron Robbs" />
  <div class="o-media__body">
    <h4>Keperluan</h4>
    <p><?php echo ucfirst($row->keperluan); ?></p>
  </div>
</div>


<hr class="c-rule"/>
  <h3 class="f3" style="float: left;margin-right: 15px;">
    <small>No. Requestion</small><br/>
    <?php echo $row->no_permintaan; ?>
  </h3>
  <h3 class="f3" style="float: left;margin-right: 15px;">
    <small>Requestion Date</small><br/>
    <?php echo $row->tgl_permintaan; ?>
  </h3>

<table class="c-table c-table--zebra">
  <thead>
    <th>#</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Description</th>
    <th>Status</th>
  </thead>
  <tbody>
    <?php
    $no='1';
    foreach ($item as $itm) {
    ?>
    <tr class="tr" onclick="window.location='<?php echo base_url().'members/detail_aktiva/'.$itm->id_item; ?>'">
      <td><?php echo $no; ?></td>
      <td><?php echo ucfirst($itm->nama_item); ?></td>
      <td><?php
      if ($itm->satuan == "Rupiah") {
      echo show_currency_format($itm->jumlah);
      }else{
        echo $itm->jumlah.' '.ucfirst($itm->satuan);
      } ?></td>
      <td><?php echo ucfirst($itm->description); ?></td>
      <td><?php echo ucfirst($itm->status); ?></td>
    </tr>

    <?php
    $no++;
    }

    ?>    
  </tbody>
</table>
<h4>Catatan :</h4>
<textarea name="catatan" class="c-input" placeholder="Tidak ada catatan" disabled><?php echo ucfirst($row->catatan); ?></textarea>

  <?php
  }     //end foreach permintaan
  ?>
</div>