<?php
if (isset($_REQUEST['cal'])) {
	$a=$_REQUEST['cal'];
	$aa=explode("#",$a);
	
	$n=sizeof($aa);
		if ($n!=22) {echo "Data mismatch $n";exit;}

	$c80=floatval($aa[11]);
		if ($c80 > 150000) $c80=150000;
	$sal=floatval($aa[6]) + floatval($aa[7]) + floatval($aa[8]) + floatval($aa[9]) - $c80 - floatval($aa[12]) + floatval($aa[13]);
	$tax1=calctax($sal,$aa[2],$aa[3],$aa[10],$aa[14],$aa[15],$aa[16],$aa[17],$aa[18],0,$aa[20],$aa[21],$aa[19]);
	//echo $tax1;exit;
	$tax2=explode("#",$tax1);
	$tax=$tax2[0];
	$sptax=$tax2[1];
	$taxinc = $sal;
	$cap5 = floatval($aa[17]) - 100000;
	if ($cap5 < 0) $cap5=0;
	
	$aa[14]=floatval($aa[14]);$aa[15]= floatval($aa[15]);$aa[16]=floatval($aa[16]);$aa[18]=floatval($aa[18]);
	$spinc=$aa[14] + $aa[15] + $aa[16]+ $aa[18];
	if ($tax<0) $ptax=0;
if (($taxinc + $spinc + floatval($aa[17])) <= 500000) {
	$ptax=$tax + $sptax - 12500;
		if ($ptax < 0) $ptax = 0;
} else {$ptax = $tax + $sptax;}
 $spinc = $spinc + $cap5;
	$grandinc = $taxinc + $spinc;
	$sur = 0;
	
if ($grandinc > 50000000) {

	$sur = $tax * .37 + $sptax * .15;
	$cess = ($ptax + $sur) * .04;
	$tot = $ptax + $cess + $sur;

	$sal1=50000000 - $spinc;	
	if ($sal1 < 0) {$aa[18]=$aa[18] + $sal1;$sal1=0;}	
	if ($aa[18] < 0) {$aa[15]=$aa[15] + $aa[18];$aa[18]=0;}	
	if ($aa[15] < 0) {$aa[14]=$aa[14] + $aa[15];$aa[15]=0;}	
	if ($aa[14] < 0) {$aa[16]=$aa[16] + $aa[14];$aa[14]=0;}
	if ($aa[16] < 0) {$cap5=$cap5 + $aa[16];$aa[16]=0;}
	//tax calculated for 5 crore
	$tax1=calctax($sal1,$aa[2],$aa[3],$aa[10],$aa[14],$aa[15],$aa[16],$cap5,$aa[18],0,$aa[20],$aa[21],$aa[19]);
	$tax2=explode("#",$tax1);	
	$tax1 = $tax2[0] + $tax2[1] + $tax2[0] * .25 + $tax2[1] * .15;
	$tax1 = $tax1 + $tax1 * .04;
	//Calculated tax + income increase above 5 crore
	$marel=$grandinc - 50000000 + $tax1;
	//Tax after marginal relief
	if ($marel < $tot) {$surpluscess = $marel - $ptax;
	$cess = $marel - round($marel / 1.04) ;
	$sur = $marel - $ptax - $cess;
	$tot = $marel;
	}
	
}
elseif ($grandinc > 20000000) {
	$sur = $tax * .25 + $sptax * .15;
	$cess = ($ptax + $sur) * .04;
	$tot = $ptax + $cess + $sur;

	$sal1=20000000 - $spinc;
	if ($sal1 < 0) {$aa[18]=$aa[18] + $sal1;$sal1=0;}	
	if ($aa[18] < 0) {$aa[15]=$aa[15] + $aa[18];$aa[18]=0;}	
	if ($aa[15] < 0) {$aa[14]=$aa[14] + $aa[15];$aa[15]=0;}	
	if ($aa[14] < 0) {$aa[16]=$aa[16] + $aa[14];$aa[14]=0;}
	if ($aa[16] < 0) {$cap5=$cap5 + $aa[16];$aa[16]=0;}
	//tax calculated for 2 crore
	$tax1=calctax($sal1,$aa[2],$aa[3],$aa[10],$aa[14],$aa[15],$aa[16],$cap5,$aa[18],1,$aa[20],$aa[21],$aa[19]);
	$tax1 = $tax1 + $tax1 * .15;
	$tax1 = $tax1 + $tax1 * .04;
	$marel=$grandinc - 20000000 + $tax1;
	if ($marel < $tot) {$surpluscess = $marel - $ptax;
	$cess = $marel - round($marel / 1.04) ;
	$sur = $marel - $ptax - $cess;
	$tot = $marel;
	}
	}
elseif ($grandinc > 10000000) {
	$sur = $ptax * .15;
	$cess = ($ptax + $sur) * .04;
	$tot = $ptax + $cess + $sur;

	$sal1=10000000 - $spinc;
	if ($sal1 < 0) {$aa[18]=$aa[18] + $sal1;$sal1=0;}	
	if ($aa[18] < 0) {$aa[15]=$aa[15] + $aa[18];$aa[18]=0;}	
	if ($aa[15] < 0) {$aa[14]=$aa[14] + $aa[15];$aa[15]=0;}	
	if ($aa[14] < 0) {$aa[16]=$aa[16] + $aa[14];$aa[14]=0;}
	if ($aa[16] < 0) {$cap5=$cap5 + $aa[16];$aa[16]=0;}
	$tax1=calctax($sal1,$aa[2],$aa[3],$aa[10],$aa[14],$aa[15],$aa[16],$cap5,$aa[18],1,$aa[20],$aa[21],$aa[19]);
	$tax1 = $tax1 + $tax1 * .1;
	$tax1 = $tax1 + $tax1 * .04;
	$marel=$grandinc - 10000000 + $tax1;
	if ($marel < $tot) {$surpluscess = $marel - $ptax;
	$cess = $marel - round($marel / 1.04) ;
	$sur = $marel - $ptax - $cess;
	$tot = $marel;
	}
	}
elseif ($grandinc > 5000000) {
	$sur = $ptax * .1;
	$cess = ($ptax + $sur) * .04;
	$tot = $ptax + $cess + $sur;
	
	$sal1=5000000 - $spinc;
	
	if ($sal1 < 0) {$aa[18]=$aa[18] + $sal1;$sal1=0;}	
	if ($aa[18] < 0) {$aa[15]=$aa[15] + $aa[18];$aa[18]=0;}	
	if ($aa[15] < 0) {$aa[14]=$aa[14] + $aa[15];$aa[15]=0;}	
	if ($aa[14] < 0) {$aa[16]=$aa[16] + $aa[14];$aa[14]=0;}
	if ($aa[16] < 0) {$cap5=$cap5 + $aa[16];$aa[16]=0;}
	
	$tax1=calctax($sal1,$aa[2],$aa[3],$aa[10],$aa[14],$aa[15],$aa[16],$cap5,$aa[18],1,$aa[20],$aa[21],$aa[19]);
	
	$tax1 = $tax1 + $tax1 * .04;
	$marel=$grandinc - 5000000 + $tax1;
	
	if ($marel < $tot) {$surpluscess = $marel - $ptax;
	$cess = $marel - round($marel / 1.04) ;
	$sur = $marel - $ptax - $cess;
	$tot = $marel;
	}
	} else {
	$sur = 0;
	$cess = ($ptax + $sur) * .04;
	$tot = $ptax + $cess + $sur;
	}
echo $taxinc."#".$tax."#".$ptax."#".$cess."#".$tot."#".$spinc."#".$sptax."#".$sur;
exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>KRIS INCOME TAX CALCULATOR INDIA</title>
	<link rel="stylesheet" href="kris.css">
	<script src='kris.js'></script>
</head>
<body>
	<form>
	<?php

		$zerotax=file_get_contents("https://krisambali.com/android/zerotax.php?taxyear=1");
		$taxrate=file_get_contents("https://krisambali.com/android/taxrate.php?taxyear=1");
        echo "<input type='hidden' id='zero' value='$zerotax' />";
		echo "<input type='hidden' id='taxrate' value='$taxrate' />";
	echo "<div class='w75' id='mydata'>";
	echo "<table class='tablem'>";
	echo "<tr><td colspan=4 class='head'>KRISAMBALI.COM</td>";
	echo "<tr><td colspan=4>INCOME TAX CALCULATION FOR INDIAN TAX PAYERS - RULES NOT FULLY COVERED BUT THIS FOR SOFTWARE DEVELOPERS<br>SOURCE CODE LINK PROVIDED AT THE END</td>";
	echo "<tr bgcolor='#F5F5F5'><td class='threefr'>Assesment Year</td><td class='onefr'><select  class='inpbox2' id='ayear' autofocus onchange='calculate(1);'><option></option><option value=1>2023-24</option></select></td>";
	echo "<td class='threefr'>Tax Payer</td><td class='onefr'><select  class='inpbox2' id='tpayer'><option value=0></option><option value=1>INDIVIDUAL</option></select></td>";
	echo "<tr><td class='threefr'>Whether opting for taxation under Section 115BAC?</td><td class='onefr'><select  class='inpboxl' id='schm' onchange='newschemopt(3);calculate();'><option value=0></option>";
	echo "<option value=1>YES</option>";
	echo "<option value=2>NO</option></select></td>";
	echo "<td class='threefr'>Select Male/ Female/ Senior Citizen</td><td class='onefr'><select  class='inpboxl' id='gender' onchange='calculate(4);'><option value=0></option><option value=1>MALE</option><option value=2>FEMALE</option><option value=3>SENIOR CITIZEN</option><option value=4>SUPER SENIOR CITYZEN</option></select></td>";
	echo "<tr bgcolor='#F5F5F5'><td class='threefr'>Resindential Status</td><td class='onefr'><select id='rsstat' class='inpbox2' onchange='calculate(5);'><option value=0></option><option value=1>RESIDENT</option></select></td>";
	echo "<td class='threefr'>Date of birth</td><td class='onefr'><input type='date' id='dob' class='inpbox2'  onchange='calculate(6);'/></td>";
	echo "<tr><td class='threefr' onmouseenter=myPopup(4); style='cursor: pointer;' onmouseleave=myPopup(4);>Salary income (Excluding standanrd ded,Prof tax etc.)</td><td class='onefr'><input type='text' id='sal' class='inpbox' onchange=indformat('sal');calculate(); /></td>";
	echo "<td class='threefr' onclick='display(1);'  onmouseenter=myPopup(5); style='cursor: pointer;' onmouseleave=myPopup(5);>Income from house property (Click to add details)</td><td class='disbox' onclick='display(1);' id='hinc' style='cursor: pointer;'></td>";
	echo "<tr bgcolor='#F5F5F5'><td class='threefr' onclick='display(2);' style='cursor: pointer;'>Capital gains (Click to add details)</td><td class='disbox'  id='captot'  onclick='display(2);'  style='cursor: pointer;'></td>";
	echo "<td class='threefr'>Income from other sources(Interest, Commission etc)</td><td class='onefr'><input type='text' id='oincome' class='inpbox3' onchange=indformat('oincome');calculate(); /></td>";
	echo "<tr><td class='threefr' colspan=3>Income from other sources Winnings from Lottery, Crossword Puzzles, etc(tax @30%)</td><td class='onefr'><input type='text' id='ltincome' class='inpbox' onchange=indformat('ltincome');calculate(); /></td>";
	echo "<tr bgcolor='#F5F5F5'><td class='threefr'>Profits and Gains of Business or Profession (enter profit only)</td><td class='onefr'><input type='text' id='profit' class='inpbox3' onchange=indformat('profit');calculate(); /></td>";
	echo "<td class='threefr'>Agriculture income (For slab purpose only)</td><td class='onefr'><input type='text' id='agri' class='inpbox3' onchange=indformat('agri');calculate(); /></td>";
	echo "<tr><td class='threefr' onmouseenter=myPopup(2); style='cursor: pointer;' onmouseleave=myPopup(2);>Deductions 80C</td><td class='onefr'><input type='text' id='c80' class='inpbox' onchange=indformat('c80');calculate(); /></td>";
	echo "<td class='threefr' onclick='display(3);' style='cursor: pointer;'>Deductions Others than 80C (Click to add details)</td><td class='disbox' id='d80' onclick='display(3);'  style='cursor: pointer;'></td>";
	echo "<tr><td colspan=4><input type='button' onclick='calculate();' value='Calculate' /></td>";
	echo "<tr bgcolor='#F5F5F5'><td  class='threefr' colspan=4 id='tdet'>Tax Details</td>";
	echo "<tr><td class='threefr'>Net Taxable income at normal rate</td><td class='disbox' id='netinc'></td>";
	echo "<td class='threefr'>Calculated Income tax at normal rate</td><td class='disbox' id='ctax'></td>";
	echo "<tr><td class='threefr'>Net Taxable income at special rate</td><td class='disbox' id='spinc'></td>";
	echo "<td class='threefr'>Calculated Income tax at special rate</td><td class='disbox' id='sptax'></td>";
	echo "<tr><td class='threefr'>Income tax payable</td><td class='disbox' id='ptax'></td>";
	echo "<td class='threefr'  onmouseenter=myPopup(11); style='cursor: pointer;' onmouseleave=myPopup(11);>Surcharge</td><td class='disbox' id='surc'></td>";
	echo "<tr><td class='threefr'>Health and Educational Cess</td><td class='disbox' id='edu'></td>";
	echo "<td class='threefr'>Total Tax liability</td><td class='disbox' id='tot'></td>";
	
	echo "</table>";
	
	echo "<div class='popup'>";
	echo "<span class='popuptext' id='myPopup1'><U>Income under section 111(A)</U><br><br>Income from Buying and selling of stocks or equity-based fund units 12 months or less from date of purchase<br>Transferring shares via a recognised stock exchange<br>STT or Securities Transaction Tax is applicable on the sale of equity shares/funds<br>STCG on selling units of a trust<br>STCG through the sale of mutual fund units, business trust units or shares via a stock exchange situated in IFSC wherein foreign currency is used (even if there is no STT)<br>Total income including this less than 2.5 L then STCG tax is 0</span>";
	echo "<span class='popuptext' id='myPopup2'>";
	echo "Applicable investments(80C)(Maximum 1.5 L)<br><br>";
	echo "1. Contributing to Provident Fund<br>2. School fees of children<br>3. LIC premium<br>4. Home loan repayment (principal amount)<br>5. Registration expenses and stamp duty of house property<br>6. Equity-Linked Savings Scheme (ELSS)<br>7. Investment in NPS greater than 50000 (50000 counted into other than 80C)<br>8  If Section 115BAC Yes opted then above deductions not applicable";
	echo "</span>";

	echo "<span class='popuptext' id='myPopup3'><U>Income under section 112(A)</U><br><br>Income from Buying and selling of stocks or equity-based fund units more than 12 months from date of purchase<br>Transferring shares via a recognised stock exchange<br>STT or Securities Transaction Tax is applicable on the sale of equity shares/funds<br>Tax is chargable above 1L only<br>Total income including this less than 2.5 L then LTCG tax is 0</span>";
	echo "<span class='popuptext' id='myPopup4'><U>Salary Income</U><br><br>1. Include salary and other allowances received<br>2. Include monthly pension received<br>3. Exclude PL encashment on retirement maximum of 3 L for employees other than Central and state goverment<br>4. If 8 months average basic + da is less than 3 lakh then excluded amount is limited to it<br>5. Exclude full PL encashment on retirement for Central and state goverment employees<br>6 Exclude standard deduction of maximum 50000<br>7 Exclude Professional tax paid<br>8 Exclude gratuivity received at the time of retirement/ resignation<br>9 Exclude pension commuttation recieved<br>10 Include NPS contribution by employer";
	echo "</span>";
	
	echo "<span class='popuptext' id='myPopup5'><U>Income from house property</U><br><br>1. For self occupied houses housing loan interest upto 2L deduction allowed<br>2. If loan is for renovation/ repair then interest deduction of 30T allowed<br>3 If Section 115BAC Yes opted then above deductions not applicable<br>4 For letout houses net income has to be arrived as per the detiled screen";
	echo "</span>";

	echo "<span class='popuptext' id='myPopup6'><U>Deduction under 80D</U><br><br>1. Amount paid for insurance premium for spouse, children and self less than 60 years old, the maximum deduction 25T.<br>2. Amount paid for insurance premium of parents less than 60 years old, the maximum deduction 25T.<br>3. Amount paid for insurance premium for spouse, children and self 60 years or above old, the maximum deduction 50T.<br>4. Amount paid for insurance premium of parents 60 years or above old, the maximum deduction 50T.<br>5. Payment made for preventive health check up (for your spouse, children and yourself) maximum deduction 5T.<br>6. Payment made for preventive health check up parents maximum deduction 5T.<br>7. Medical insurance premiums should be paid through non-cash modes to be eligible<br>8. For your spouse, children and yourself total is limited to 50T.<br>9. For your parents total is limited to 50T.<br>10 For spouse, children, yourself and parents total limited to 1L.";
	echo "</span>";
	echo "<span class='popuptext' id='myPopup7'><U>Deduction Under section 80CCD(1)</U><br><br>1. Contribution by employer towards NPS a maximum of 14% salary in case of Cetral and state Govt employees.<br>2. Contribution by employer towards NPS a maximum of 10% salary in case of other employees.<br>3. For the purposes of this section, salary includes DA but excludes all other allowances and perquisites";
	echo "</span>";

	echo "<span class='popuptext' id='myPopup8'><U>Deduction Under section 80CCF</U><br><Br>1. Contribution by employee towards specified infrastructure bonds and other tax saving bonds.<br>2. Maximum amount eligible under this section is 20T.<br>3. Normally this type of bonds have 5years of lock in period";
	echo "</span>";

	echo "<span class='popuptext' id='myPopup9'><U>Deduction Under section 80CCG</U><br><br>1. It is also known as the Rajiv Gandhi Equity Savings Scheme (RGESS)<br>2. This deduction is applicable to new retail investors in share market for three consecutive years.<br>3. Maximum amount allowed is 25T.<br>4. 50% of investment may be considered for this purpose<br>5. For this deduction gross total income should be less than 12L.<br>6. The listed equity shares or listed units of the equity-oriented fund must be specified under the scheme and have a lock-in period of three years";
	echo "</span>";

	echo "<span class='popuptext' id='myPopup10'><U>Deduction Under section 80DDB</U><br><br>1. Maximum deduction allowed under this section is 40T (For senior cityzen it is 1L)<br>2. Deduction applicable to treatment of self, spouse, children, parents, brothers or sisters<br>3. The deduction allowed for the amount paid for the treatment of following deseases only<br>a. Hematological disorders - 1. Thalassaemia and 2. Hemophilia.<br>b. Full Blown Acquired Immuno Deficiency Syndrome (AIDS)<br>c. Malignant Cancers<br>d. Neurological Disease (where the disability level has been 40% or above) 1. Motor Neuron Disease. 2. Chorea. 3. Aphasia. 4. Dementia. 5. Parkinsons Disease. 6. Dystonia Musculorum Deformans. 7. Ataxia. 8. Hemiballismus<br>e. Chronic Renal failure";
	echo "</span>";

	echo "<span class='popuptext' id='myPopup11'><U>Income tax surcharge</U><br><br>1. If total income is greater than 50 Lakh and 1 Crore or less 10% surcharge for calculated tax<br>2. If total income is greater than 1 Croe and 2 Crore or less 15% surcharge for calculated tax<br>3. If total income is greater than 2 Crore and 5 Crore or less 25% surcharge for calculated tax<br>4. If total income is greater than 5 Crore 37% surcharge for calculated tax<br>5. Marginal relief applicable for surcharge calculation<br>6. Taxable income at special rate other than winning from lottery and puzle maximum surcharge applicable is 15%";
	echo "</span>";

	echo "</div>";

	echo "<div id='house' style='display:none;'>";
	echo "<div id='ipsel'>";
	echo "<table class='tablem'>";
	echo "<tr><td style='width:500px;' id='h1' colspan=4 bgcolor='#C0C0C0'>Income from Self occupied house</td><tr><td class='threefr' id='ips'>Interest paid self occupied house</td><td class='onefr'><input type='text' id='ipself' class='inpbox' onchange=housing('ipself');calculate(); /></td>";
	echo "</td></table></div>";
	echo "<table class='tablem'>";
	echo "<tr><td colspan=4 class='threefr' bgcolor='#C0C0C0'>Income from rented house</td>";
	echo "<tr><td class='threefr'>Annual Letable Value/Rent Received or Receivable</td><td class='onefr'><input type='text' id='hrent' class='inpbox'  onchange=housing('hrent');calculate(); /></td>";
	echo "<td class='threefr'>Less: Municipal Taxes Paid During the Year</td><td class='onefr'><input type='text' id='htax' class='inpbox' onchange=housing('htax');calculate();  /></td>";
	echo "<tr><td class='threefr'>Less:Unrealized Rent</td><td class='onefr'><input type='text' id='rpend' class='inpbox' onchange=housing('rpend');calculate(); /></td>";
	echo "<td class='threefr'>Net Annual Value</td><td class='disbox' id='hnet'></td>";
	echo "<tr><td class='threefr'>Standard Deduction @ 30% of Net Annual Value</td><td class='disbox' id='hstd'></td>";
	echo "<td class='threefr'>Interest on Housing Loan (Let out house)</td><td class='onefr'><input type='text'  id='iplet' class='inpbox' onchange=housing('iplet');calculate();  /></td>";
	echo "<tr><td class='threefr'>Income from Let-out House Property</td><td class='disbox' id='inclet'></td>";
	echo "<tr><td colspan=4><input type='button' onclick='hide(1);' value='Hide' /></td>";
	echo "</table>";
	echo "</div>";

	echo "<div id='capital' style='display:none;'>";
	echo "<table class='tablem'>";
	echo "<tr><td class='long'>Short Term Capital GainS (Other than covered under section 111A)</td><td class='onefr'><input type='text' id='cap1' class='inpbox' onchange=capital('cap1');calculate(); /></td>";
	echo "<tr><td class='long'  onmouseenter=myPopup(1); style='cursor: pointer;' onmouseleave=myPopup(1);>Short Term Capital GainS (Covered under section 111A tax @ 15%)</td><td class='onefr'><input type='text' id='cap2' class='inpbox'  onchange=capital('cap2');calculate(); /></td>";
	echo "<tr><td class='long'>Long Term Capital Gains (Charged to tax @ 20%)</td><td class='onefr'><input type='text' id='cap3' class='inpbox' onchange=capital('cap3');calculate();  /></td>";
	echo "<tr><td class='long'>Long Term Capital Gains (Charged to tax @ 10%)</td><td class='onefr'><input type='text' id='cap4' class='inpbox' onchange=capital('cap4');calculate();  /></td>";

	echo "<tr><td class='long'  onmouseenter=myPopup(3); style='cursor: pointer;' onmouseleave=myPopup(3);>Long Term Capital Gains under section 112A(Charged to tax @ 10% above Rs.1 L)</td><td class='onefr'><input type='text' id='cap5' class='inpbox' onchange=capital('cap5');calculate();  /></td>";

	echo "<tr><td colspan=2><input type='button' onclick='hide(2);' value='Hide' /></td>";
	echo "</table>";
	echo "</div>";

	echo "<div id='ded80' style='display:none;'>";
	echo "<table class='tablem'>";
	echo "<tr><td class='long' onmouseenter=myPopup(7); style='cursor: pointer;' onmouseleave=myPopup(7)>Employer's contribution toward NPS u/s 80CCD(1)</td><td class='onefr'><input type='text' id='d2' class='inpbox' onchange=ded80('d3',999999999);calculate();  /></td>";
	echo "</table>";
	echo "<div id='ded80_1'>";
	echo "<table class='tablem'>";
	echo "<tr><td class='long'>Additional contribution towards NPS [u/s 80CCD(1B)] (Maximum 50000)</td><td class='onefr'><input type='text' id='d2' class='inpbox'  onchange=ded80('d3',50000);calculate(); /></td>";
	echo "<tr><td class='long' onmouseenter=myPopup(8); style='cursor: pointer;' onmouseleave=myPopup(8);>Long-term infrastructure bonds (u/s 80CCF)</td><td class='onefr'><input type='text' id='d4' class='inpbox' onchange=ded80('d4',20000);calculate(); /></td>";
	echo "<tr><td class='long' onmouseenter=myPopup(9); style='cursor: pointer;' onmouseleave=myPopup(9);>50 % of Investment under equity saving scheme u/s 80CCG</td><td class='onefr'><input type='text'  id='d5' class='inpbox' onchange=ded80('d5',25000);calculate();  /></td>";
	echo "<tr><td class='long' onmouseenter=myPopup(6); style='cursor: pointer;' onmouseleave=myPopup(6);>Medi-claim premium (u/s 80D) (25T to 1.00L)</td><td class='onefr'><input type='text' id='d6' class='inpbox' onchange=ded80('d6',100000);calculate(); /></td>";
	echo "<tr><td class='long' onmouseenter=myPopup(10); style='cursor: pointer;' onmouseleave=myPopup(10);>Actual payment towards medical treatment (u/s 80DDB) (Specified deseases maximum 100000)</td><td class='onefr'><input type='text' id='d7' class='inpbox'  onchange=ded80('d7',100000);calculate(); /></td>";
	echo "<tr><td class='long'>Donations (u/s 80G)</td><td class='onefr'><input type='text' id='d8' class='inpbox' onchange=ded80('d8',9999999999);calculate();  /></td>";
	echo "<tr><td class='long'>Deduction for maintenance / medical treatment of dependent (Differently abled) (u/s 80DD) (Maximum 125000)</td><td class='onefr'><input type='text' id='d9' class='inpbox' onchange=ded80('d9',125000);calculate();  /></td>";
	echo "<tr><td class='long'>Interest on loan for higher education (u/s 80E)</td><td class='onefr'><input type='text'  id='d10' class='inpbox' onchange=ded80('d10',9999999999);calculate();  /></td>";
	echo "<tr><td class='long'>Interest on loan taken for Residential House sanctioned between 01.04.2016 and 31.03.2017  (u/s 80EE)</td><td class='onefr'><input type='text' id='d11' class='inpbox'  onchange=ded80('d11',50000);calculate(); /></td>";
	echo "<tr><td class='long'>Deduction in case of a person with disability (u/s 80U) (75000 to 125000)</td><td class='onefr'><input type='text' id='d12' class='inpbox' onchange=ded80('d12',125000);calculate();  /></td>";
	echo "<tr><td class='long'>Interest on deposits in saving account (u/s 80TTA) (Maximum 10000)</td><td class='onefr'><input type='text' id='d13' class='inpbox' onchange=ded80('d13',10000);calculate();  /></td>";
	echo "<tr><td colspan=4><input type='button' onclick='hide(3);' value='Hide' /></td>";
	echo "</table></div>";
	echo "</div>";
	echo "</div><div class='w25'>";
	echo "<table><tr><td class = 'b' onClick=location.href='../incometax/index.php'>INCOME TAX CALCULATOR</td></tr>";
    echo "<tr><td class = 'b' onClick=location.href='../incometax/index.php'>HTML CALCULATOR</td></tr>";
    echo "<tr><td class = 'b' onClick=location.href='../incometax/index.php'>PHP CALCULATOR</td></tr>";
    echo "<tr><td class = 'b' onClick=location.href='../incometax/index.php'>ANDROID STUDIO CALCULATOR</td></tr>";
	echo "<tr><td class = 'b' onClick=location.href='../incometax/index.php'>ANDROID STUDIO FETCH DATA FROM WEB</td></tr> ";    
    echo "<tr><td class = 'b'></td></tr>";
    echo "<tr><td class = 'b'></td></tr>";
	echo "<tr><td class = 'b'></td></tr> ";    
    echo "<tr><td class = 'b'></td></tr>";
    echo "<tr><td class='c'><img src='../images/kris.jpg'  class='image-contain' /></td></tr>";
    echo "</table>";
	echo "</div>";

function  calctax($sal,$schm,$gender,$agri,$cap2,$cap3,$cap4,$cap5,$lot,$type,$amt1,$trate1,$notax) {

	$amt=explode(",",$amt1);
	$n=sizeof($amt) - 1;
	
	$trate=explode(",",$trate1);
	$cap5 = floatval($cap5) - 100000;
	if ($cap5 < 0) $cap5 = 0;
	$spinc=floatval($cap2) + floatval($cap3) + floatval($cap4) + $cap5;
		if ($sal < 250000) {
			if (($sal + $spinc)<250000.01) {$sptax1="0.00";$sptax2="0.00";$sptax3="0.00";$sptax4="0.00";}
			else {
			$diff = $sal + floatval($cap4) + floatval($cap2) + floatval($cap3) + $cap5 - 250000;
			if ($diff < floatval($cap4)) {$sptax3=$diff * .1;}
			elseif ($diff < (floatval($cap4) + $cap5)) {$sptax3=floatval($cap4) * .1;$sptax4=($diff - $cap5) * .1;}

			elseif ($diff < (floatval($cap4) + $cap5 + floatval($cap2))) {$sptax3=floatval($cap4) * .1;$sptax4=$cap5*.1;$sptax1=($diff - floatval($cap4)) * .15;}
			else {$sptax3=floatval($cap4) * .1;$sptax4=$cap5*.1;$sptax1=(floatval($cap4)  + floatval($cap2)) * .15;$sptax2=($diff - floatval($cap4)- floatval($cap2)) * .2;}
			}
		$spinc= $spinc + floatval($lot);
		$sptax5=floatval($lot) * .30;
		} else {
		$spinc= $spinc + floatval($cap4);
		$sptax1=floatval($cap2) * .15;
		$sptax2=floatval($cap3) * .20;
		$sptax3=floatval($cap4) * .10;
		$sptax4=$cap5*.1;
		$sptax5=floatval($lot) * .30;
		}
	$sptax = $sptax1 + $sptax2 + $sptax3 + $sptax4 + $sptax5;
	if ($agri=="") $agri=0;
	$taxinc = $sal;
	
	$tax=0;
	$sal=$sal + $agri;
	$notax = $notax + $agri;
		for ($i=$n;$i>0;$i--) {
			$nextamt = $amt[$i - 1] ;
			if ($notax > $nextamt) {$nextamt=$notax;}
			$sal1=$sal -$nextamt;
			if ($sal1 > 0) {
			$tax1 = $sal1 * $trate[$i] / 100;
			$tax = $tax + $tax1;
			$sal = $amt[$i-1];
			}
		}
	if ($type==0) {
		return $tax."#".$sptax;
	} else {
		$tax = $tax + $sptax;
		return $tax;
	}
}
?>
</form></body></html>