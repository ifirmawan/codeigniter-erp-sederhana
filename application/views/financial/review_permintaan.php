<div class="row fin-row">
      <div class="col-xs-12 col-md-8">
        <?php
        foreach ($permintaan as $row) {
        ?>
        <h3 class="f3"><?php echo ucwords($row->judul_permintaan); ?>
          <br/>
          <small>Diajukan pada <?php echo $row->tgl_permintaan; ?> . Oleh : <a href="#"><?php foreach ($oleh as $dari) {
            echo $dari->username;
          } ?></a></small>
        </h3>
      </div>  
      <div class="col-xs-12 col-md-4">
        <div style="text-align: right;">
          <button onclick="history.back();" class="c-btn c-btn--tertiary" style="outline: none;">
            <i class="fa fa-arrow-left"></i>
            Kembali
          </button>
          <button class="c-btn c-btn--secondary">
            <i class="fa fa-print"></i>
            Cetak
          </button>

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
    <th>Accept</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
    $no='1';
    foreach ($item as $itm) {
    ?>
    <tr>
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
      <form action="<?php echo base_url(). 'members/update_review/'. $itm->id_item; ?>" method="post">
      <td><select name="status">
        <option value="2">Yes</option>
        <option value="1">No</option>
      </select></td>
      <td><button type="Submit" class="c-btn c-btn--secondary"></i> Submit</button></td>
      </form>
    </tr>
    <?php
    $no++;
    }
    ?>    
  </tbody>
</table>
<form action="<?php echo base_url(). 'members/selesai_review/' .$id_permintaan ?>" method="post">
<h4>Catatan :</h4>
<textarea name="catatan" class="c-input" placeholder="Catatan lain untuk permohon"><?php echo ucfirst($row->catatan); ?></textarea>
<div style="text-align: right;">
    <button class="c-btn c-btn--primary">
      <i class="fa fa-send"></i>
      Selesai
    </button>
</div>
</form>
<?php
  }     //end foreach permintaan
  ?>

      </div>
    </div>