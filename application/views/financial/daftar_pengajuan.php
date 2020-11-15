<div class="row" style="padding-left: 22px;">
      <div class="col-xs-12 col-md-8">
    <span ><!--class="u-pad-s" -->
            <input class="c-input" placeholder="search anything here"  />
          </span>
      </div>
      <div class="col-xs-12 col-md-4">
            <div style="text-align: right;">
            
            <button onclick="window.location='<?php echo base_url(). 'members/selesai' ?>'" class="c-btn c-btn--primary" >
              <i class="fa fa-times-circle-o"></i>&nbsp;
                Selesai
            </button>

          </div>
         
      </div>
</div>
  
<table class="c-table c-table--zebra">
  <thead>
    <th>Number</th>
    <th>Type</th>
    <th>Name</th>
    <th>Amount</th>
    <th>Unit</th>
    <th>Description</th>
    <th>Action</th>
  </thead>
  <tbody>
    <?php
    foreach ($pengajuan as $row) { 
    ?>
    <form action="<?php echo base_url(). 'kepala_departement/post_pengajuan'; ?>" method="post">
      <input type="hidden" name="id_item" value="<?php echo $row->id_item; ?>">
      <input type="hidden" name="nama_item" value="<?php echo $row->nama_item ?>">
      <input type="hidden" name="jumlah" value="<?php echo $row->jumlah ?>">
      <input type="hidden" name="satuan" value="<?php echo $row->satuan ?>">
      <input type="hidden" name="description" value="<?php echo $row->description; ?>">
      <input type="hidden" name="id_permintaan" value="<?php echo $row->id_permintaan; ?>" >
      <input type="hidden" name="jenis_pengajuan" value="<?php echo $row->jenis_pengajuan; ?>">
    <tr>
      <td><?php echo $row->no_permintaan; ?></td>
      <td><?php echo $row->jenis_pengajuan; ?></td>
      <td><?php echo $row->nama_item; ?></td>
      <td><?php echo $row->jumlah; ?></td>
      <td><?php echo $row->satuan ?></td>
      <td><?php echo $row->description; ?></td>
            
      <td><button type="Submit" name="btn_function" value="ajukan" class="c-btn c-btn--secondary" <?php $btn_dept; ?> ><i class="fa fa-paper-plane"></i>&nbsp; Ajukan</button>
      </td>     
    </tr>
    </form>

    <?php
    }
    ?>    
  </tbody>
</table>