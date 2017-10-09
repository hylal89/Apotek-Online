<ul class="nav nav-tabs">
	<li class="active"><a href="#default-tab-1" data-toggle="tab">Form Retur Pembelian Barang</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane fade active in" id="default-tab-1">
        <div class="container-fluid">
        <span class="pull-right fa-stack fa-4x text-muted">
            <i class="fa fa-square-o fa-stack-2x"></i>
            <i class="fa fa-exchange fa-stack-1x"></i>
        </span>
		<h3>Form Retur Pembelian</h3>
		<p>
			Menu ini digunakan untuk melakukan transaksi Retur Pembelian barang/Obat pada suplier.
		</p>
        </div>
<?php 
$this->apotek->message();
//cek jika session cart transaksi tersedia
if (empty($this->session->userdata('cart_retur_pembelian'))):
// cek jika terdapat transaksi yg belum dikonfirmasi
$faktur 	= $this->data_pembelian->group_faktur();
$suplier 	= $this->master_suplier->result();
?>

		<hr/>
			<h5>1.Pencarian Faktur Pembelian:</h5>
			<?php echo form_open('transaksi/pembelian/retur/proses', 'class="form-horizontal" data-parsley-validate="true"');?>
		        <div id="form1">
                    <div class="form-group">
                        <label class="col-md-3 control-label">No. Faktur <span class="semi-bold text-danger">*</span></label>
                        <div class="col-md-9">
                            <select name="no_faktur" required="" class="form-control selectpicker" data-size="4" data-live-search="true" data-style="btn-white">
                                <option value="" selected>-- Pilih No. Faktur Pembelian --</option>
                                <?php if ($faktur !== FALSE):?>
                                <?php foreach ($faktur as $items):?>
                                <option value="<?=$items->no_faktur;?>"><?=$items->no_faktur;?></option>
                            	<?php endforeach;?>
                            	<?php endif;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Suplier <span class="semi-bold text-danger">*</span></label>
                        <div class="col-md-9">
                            <select name="suplier" required="" class="form-control selectpicker" data-size="4" data-live-search="true" data-style="btn-white">
                                <option value="" selected>-- Pilih Suplier --</option>
                                <?php if ($suplier !== FALSE):?>
                                <?php foreach ($suplier as $items):?>
                                <option value="<?=$items->id_suplier;?>"><?=$items->suplier;?></option>
                            	<?php endforeach;?>
                            	<?php endif;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
		                <label class="col-md-3 control-label">Tgl. Retur Pembelian <span class="semi-bold text-danger">*</span></label>
		                <div class="col-md-9">
		                    <input name="tgl_retur" required="" type="date" class="form-control" placeholder="tgl transaksi" value="<?php echo date('d-m-Y');?>" />
		                </div>
		            </div>
                    <p class="bold pull-left">Keterangan : <br/>
                    Silahkan cek dengan benar form transaksi ini. agar tidak terjadi kesalahan dalam sistem E-Apotek.<br/>
                    <strong><span class="text-danger">*) Wajib di isi.</span></strong>
                    </p>
		            <div class="form-group">
		            	<div class="col-md-2  pull-right">
		            	<button type="submit" class="form-control btn btn-success">Proses</button>
		            	</div>
		            </div>
		        </div>
	    	<?php echo form_close();?>
<?php else:?>
        	<hr/>

<?php 
	$transaksi 	= $this->session->userdata('cart_retur_pembelian');
	$operator 	= $this->master_user->where($transaksi['id_user']);
	$suplier 	= $this->master_suplier->where($transaksi['id_suplier']);
?>

        <div class="col-md-8">
            <p><span class="semi-bold">2. Daftar Barang Berdasarkan No Faktur Pembelian.</span><br/>Silahkan pilih daftar item yg akan di retur. dan klik konfirmasi untuk menyimpan proses retur pembelian.</p>
        </div>
        <div class="pull-right col-md-4">
            <div class="text-right">
            	Tgl Transaksi : <?= $this->apotek->date($transaksi['tgl_transaksi'],false);?><br/>
            	Suplier : <?= $suplier['suplier'];?><br/>
                Jenis Transaksi : <?= $transaksi['jenis_transaksi'];?><br/>
                Operator : <?= $operator['nama_lengkap'];?><br/>
            	Tgl Retur : <?= $this->apotek->date($transaksi['tgl_retur'],false);?><br/>
                <h5 class="semi-bold">No. Faktur : <?php echo $transaksi['no_faktur'];?></h5>
            </div>
        </div>
       	<table class="table table-hover table-condensed table-th-valign-middle table-td-valign-middle table-striped table-bordered text-center">
        	<thead>
        		<tr>
        			<th class="text-center" colspan="3">Rincian Barang</th>
        			<th class="text-center" colspan="5">Rincian Pembelian Barang</th>
        			<th class="text-center" colspan="2">Rincian Retur Penjualan</th>
        			<th rowspan="2" class="text-center">Action</th>
        		</tr>
        		<tr>
                    <th class="col-md-1 text-center">ID BELI</th>
                    <th class="col-md-2 text-center">LOKASI BARANG</th>
        			<th class="col-md-3">Nama Barang</th>
                    <th class="col-md-1 text-center">QTY</th>
        			<th class="col-md-1 text-center">HARGA POKOK</th>
                    <th class="col-md-1 text-center">Disc%</th>
                    <th class="col-md-1 text-center">PPN%</th>
                    <th class="col-md-1 text-center">Sub Total</th>
                    <th class="col-md-1 text-center">Retur</th>
        			<th class="col-md-2 text-center">Total Retur</th>
        		</tr>
        	</thead>
        	<tbody>
        	<?php
                $no         = 0;
    			$qty 		= 0;
    			$harga 		= 0;
    			$total 		= 0;
    			$sub_retur  = 0;
    			$grand_total_retur = 0;
                $cart 		= $this->db->where('no_faktur',$transaksi['no_faktur'])
                               		 	->get('tb_cart_pembelian');

                if ($cart->num_rows() > 0):

        			foreach ($cart->result() as $cart_barang):
        			$retur 	 	        = $this->data_pembelian->retur($cart_barang->id_beli);
        			$harga_sub_retur 	= $retur * $cart_barang->harga_pokok;
                    $discount          	= $harga_sub_retur - $cart_barang->discount / 100 * $harga_sub_retur;
                    $sub_retur         	= $discount + $cart_barang->ppn / 100 * $discount;
                    $dt_obat 	= $this->db->where('id_obat',$cart_barang->id_barang)
                                        ->order_by('date','DESC')
                                        ->get('tb_data_obat');
                    $cek_retur = $this->db->where('faktur',$transaksi['no_faktur'])
                                            ->where('id_barang',$cart_barang->id_barang)
                                            ->where('status','TRUE')
                                            ->get('tb_data_retur');
                if ($cek_retur->num_rows() == 0):?>
        		<tr>
                    <td class="small col-md-2">
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->id_beli;
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td class="small">
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            $id_beli = $cart_barang->id_beli;
                            $query   = $this->db->where('id_beli',$id_beli)->get('tb_cart_pembelian');
                            $lokasi  = $this->db->where('id_lokasi',$query->row()->id_lokasi)->get('tb_lokasi_barang');
                            echo $lokasi->row()->nama_lokasi;
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td class="text-left">
        				<?php 
        				if ($dt_obat->num_rows() == 0) 
    					{
    						echo "<span class='text-danger semi-bold'>Rincian tidak ditemukan. data obat telah dihapus.<br/><small>silahkan hapus items ini dari keranjang pembelian.</small></span>";
    					}
    					else
    					{
    						echo '<img src="'.base_url('assets/img/obat/'.$dt_obat->row()->foto).'" height="45px" width="45px"> ';
        					echo $dt_obat->row()->nama_obat;
    					}
        				?>
                    </td>
        			<td>
        				<?php 
        				if ($dt_obat->num_rows() > 0) 
    					{
        					echo $cart_barang->qty;
        				}
        				else
        				{
        					echo "-";
        				}
        				?>
        			</td>
        			<td>
        				<?php 
        				if ($dt_obat->num_rows() > 0) 
    					{
        					echo $this->apotek->rupiah($cart_barang->harga_pokok);
        				}
        				else
        				{
        					echo "-";
        				}
        				?>
        			</td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->discount.'%';
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->ppn.'%';
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
        				<?php 
        				if ($dt_obat->num_rows() > 0) 
    					{
        					echo $this->apotek->rupiah($cart_barang->total_harga);
        				}
        				else
        				{
        					echo "-";
        				}
        				?>
        			</td>
        			<td>
        				<?php 
        				if ($dt_obat->num_rows() > 0) 
    					{
        					echo $retur;
        				}
        				else
        				{
        					echo "-";
        				}
        				?>
        			</td>
        			<td>
        				<?php 
        				if ($dt_obat->num_rows() > 0) 
    					{
        					echo $this->apotek->rupiah($sub_retur);
        				}
        				else
        				{
        					echo "-";
        				}
        				?>
        			</td>
        			<td>
        				<a href="#retur-barang-<?=$cart_barang->id_beli;?>" class="btn btn-success" data-toggle="modal">Retur</a>
        			</td>
        		</tr>
                <?php else:?>
                <tr>
                    
                    <td class="small col-md-2">
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->id_beli;
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td class="small">
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            $id_beli = $cart_barang->id_beli;
                            $query   = $this->db->where('id_beli',$id_beli)->get('tb_cart_pembelian');
                            $lokasi  = $this->db->where('id_lokasi',$query->row()->id_lokasi)->get('tb_lokasi_barang');
                            echo $lokasi->row()->nama_lokasi;
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td class="text-left">
                        <?php 
                        if ($dt_obat->num_rows() == 0) 
                        {
                            echo "<span class='text-danger semi-bold'>Rincian tidak ditemukan. data obat telah dihapus.<br/><small>silahkan hapus items ini dari keranjang pembelian.</small></span>";
                        }
                        else
                        {
                            echo '<img src="'.base_url('assets/img/obat/'.$dt_obat->row()->foto).'" height="45px" width="45px"> ';
                            echo $dt_obat->row()->nama_obat;
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->qty;
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $this->apotek->rupiah($cart_barang->harga_pokok);
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->discount.'%';
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $cart_barang->ppn.'%';
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $this->apotek->rupiah($cart_barang->total_harga);
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $retur;
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <?php 
                        if ($dt_obat->num_rows() > 0) 
                        {
                            echo $this->apotek->rupiah($sub_retur);
                        }
                        else
                        {
                            echo "-";
                        }
                        ?>
                    </td>
                    <td>
                        <span class="label label-danger label-sm">SUDAH DIRETUR</span>
                    </td>
                </tr>
        	<?php
                endif;
                if ($cek_retur->num_rows() == 0)
                {
        			$harga 	+= $cart_barang->harga_pokok;
        			$qty 	+= $cart_barang->qty;
        			$total 	+= $cart_barang->total_harga;
        			$grand_total_retur += $sub_retur;
                    $no 	+= $retur;
                }
                    endforeach;
        		else:
        	?>
        		<tr>
        			<td colspan="11">Belum ada barang yang di tambahkan ke keranjang retur</td>
        		</tr>
        	<?php
        		endif;
        	?>
        	</tbody>
            <tfoot>
                <?php if ($transaksi['jenis_transaksi'] === 'HUTANG'):?>
                <?php 

                    $pembayaran = $this->db->where('no_faktur',$transaksi['no_faktur'])
                                                        ->get('tb_data_hutang');
                            
                    if ($pembayaran->num_rows() > 0) 
                    {
                        $hutang     = $pembayaran->row();
                        $bayar      = $hutang->total_bayar - $hutang->dibayar;
                        $total      = $total - $bayar;
                        if ($hutang->status !== 'LUNAS') 
                        {
                            if ($grand_total_retur > $hutang->dibayar) 
                            {
                                $grand_total_retur = $hutang->dibayar;
                            }
                        }
                    }?>
                <tr>
                    <th class="text-right" colspan="9">Total Hutang<br/>Di bayar<br/>Sisa Hutang</th>
                    <th colspan="3"><?=$this->apotek->rupiah($hutang->total_bayar);?><br/><?=$this->apotek->rupiah($hutang->dibayar);?><br/><?=$this->apotek->rupiah($bayar);?> <small><?=$hutang->status;?></small></th>
                </tr>
                <?php endif;?>
                <tr>
                    <th class="text-right" colspan="9"><h4>Grand Total</h4></th>
                    <th colspan="3"><h4><?=$this->apotek->rupiah($grand_total_retur);?></h4></th>
                </tr>
            </tfoot>
       	</table>
        <div class="row">
        	<div class="col-md-12">
       		 	<p class="pull-left">Keterangan : <br/>
			        Sebelum melakukan konfirmasi. Silahkan cek dengan benar form transaksi ini. agar tidak terjadi kesalahan dalam sistem E-Apotek.<br/>
                    Silahkan pilih barang yang akan diretur. sesuai lokasi barang tsb dan ID BELI barang tsb. <br/>
                    Barang yang akan diretur akan mengurangi jumlah stok barang sesuai jumlah yang akan diretur dan akan membuat transaksi keuangan bertambah sesuai total yang akan diretur.<br/> 
			        <strong><span class="text-danger">*) Wajib di isi.</span></strong>
        		</p>
        	</div>
        </div>
        <?php echo form_close();?>
        <hr/>
       	<p class="text-right m-b-0">
			<a href="<?php $this->apotek->url('transaksi/pembelian/retur/reset');?>" class="btn btn-white m-r-5">Reset</a>
       		<?php
	    		if ($cart->num_rows() > 0)
	    		{
	    			if ($dt_obat->num_rows() > 0 AND $no > 0) 
					{
    					echo '<a href="#konfirmasi" class="btn btn-primary" data-toggle="modal">Konfirmasi</a>';
    				}
	    		}	
    		?>
		</p>

        <div class="modal fade" id="konfirmasi">
            <div class="modal-dialog">
                <div data-init="true" class="panel panel-danger">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Konfirmasi Retur Pembelian</h4>
                    </div>
                    <div class="panel-body">
                    <?php echo form_open('transaksi/pembelian/retur/save','class="form-horizontal"  data-parsley-validate="true"');?>
                    <p>
                    <div class="col-md-12 form-group">
                        <label class="col-md-3 control-label">No. Faktur  <span class="semi-bold text-danger">*</span></label>
                        <div class="col-md-9">
                        	<input type="hidden" name="no_retur" value="<?=$transaksi['no_retur'];?>">
                            <input required="" readonly="" name="no_faktur" type="text" class="form-control" placeholder="total_items" value="<?php echo $transaksi['no_faktur'];?>"/>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="col-md-3 control-label">Suplier  <span class="semi-bold text-danger">*</span></label>
                        <div class="col-md-9">
                            <input required="" readonly="" name="no_faktur" type="text" class="form-control" placeholder="total_items" value="<?php echo $suplier['suplier'];?>"/>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="col-md-3 control-label">Jumlah Retur  <span class="semi-bold text-danger">*</span></label>
                        <div class="col-md-9">
                            <input required="" readonly="" name="total_items" type="text" class="form-control" placeholder="total_items" value="<?php echo $no;?>"/>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <label class="col-md-3 control-label">Total Retur  <span class="semi-bold text-danger">*</span></label>
                        <div class="col-md-9">
                            <input type="hidden" name="total_retur" value="<?=$grand_total_retur;?>">
                            <input required="" readonly="" name="total" type="text" class="form-control" placeholder="total_items" value="<?php echo $this->apotek->rupiah($grand_total_retur);?>"/>
                        </div>
                    </div>
                    Apakah anda yakin ingin menyimpan retur penjualan ini?<br/>
                    dengan mengklik simpan akan memperbaharui stok barang yang ada dalam sistem ini.</p>
                    <hr/>
                    <div class="pull-right">
                        <button type="submit" class="btn btn-danger btn-sm">Simpan</button>
                    </div>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
<?php if($cart->num_rows() > 0):

        			foreach ($cart->result() as $cart_barang):
                    $dt_obat = $this->db->where('id_obat',$cart_barang->id_barang)
                                        ->order_by('date','DESC')
                                        ->get('tb_data_obat');
        		?>
		<div class="modal fade" id="retur-barang-<?=$cart_barang->id_beli;?>">
			<div class="modal-dialog">
				<div data-init="true" class="panel panel-success" data-sortable-id="ui-widget-11">
                    <div class="panel-heading">
                        <div class="panel-heading-btn">
                            <a href="#" class="btn btn-xs btn-icon btn-circle btn-danger" data-dismiss="modal"><i class="fa fa-times"></i></a>
                        </div>
                        <h4 class="panel-title">Retur Barang</h4>
                    </div>
                    <div class="panel-body">
                    <?php echo form_open('transaksi/pembelian/retur/proses-items','class="form-horizontal"  data-parsley-validate="true"');?>
                        <div id="form2">

                            <div class="col-md-12 form-group">
                                <label class="col-md-3 control-label">ID BELI <span class="semi-bold text-danger">*</span></label>
                                <div class="col-md-9">
                                    <input required="" readonly="" name="id_beli" type="text" class="form-control" placeholder="ID Jual" value="<?=$cart_barang->id_beli;?>" />
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
				                <label class="col-md-3 control-label">Nama Barang <span class="semi-bold text-danger">*</span></label>
				                <div class="col-md-9">
				                	<input type="hidden" name="id_barang" value="<?=$cart_barang->id_barang;?>">
				                    <input name="nama_barang" readonly="" required="" type="text" class="form-control" placeholder="Nama Barang" value="<?=$dt_obat->row()->nama_obat;?>"/>
				                </div>
				            </div>
				            
                            <div class="col-md-12 form-group">
				                <label class="col-md-3 control-label">QTY <span class="semi-bold text-danger">*</span></label>
				                <div class="col-md-9">
				                    <input name="qty" required="" type="number" class="form-control" placeholder="Jumlah Penjualan barang" readonly="" value="<?=$cart_barang->qty;?>"/>
				                </div>
				            </div>

				            <div class="col-md-12 form-group">
				                <label class="col-md-3 control-label">Jumlah Retur <span class="semi-bold text-danger">*</span></label>
				                <div class="col-md-9">
				                    <input name="retur" required="" type="number" class="form-control" placeholder="Jumlah barang yang diretur" value=""/>
				                </div>
				            </div>
				            
                            <div class="col-md-12 form-group">
				            	<div class="col-md-12">
				            		<button type="submit" class="btn btn-success btn-sm pull-right small">Retur Items</button>
				            	</div>
				            	<p class="pull-left">Perhatian! Jumlah Retur tidak boleh lebih dari jumlah QTY</p>
				            </div>

				        </div>
                    </div>
                    <?php echo form_close();?>
                </div>
			</div>
		</div>
   			<?php endforeach;?>
        <?php endif;?>
<?php endif;?>
	</div>
</div>