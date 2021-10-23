<?php

class m140821_124310_insert_insurance_category extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m140821_124310_insert_insurance_category does not support migration down.\n";
		return false;
	}*/


	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-0BF-QVXOJ-B342' WHERE (`id`='1')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?03918-5JV-OG3VG-U5ZT' WHERE (`id`='2')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391E-K1Q-BM1Y5-04VJ' WHERE (`id`='5')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-IKT-FURC8-VV6R' WHERE (`id`='6')");

        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-MJT-3MWZC-C83M' WHERE (`id`='8')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-RUX-G6ORF-L41E' WHERE (`id`='9')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391M-78O-8NS7E-472B' WHERE (`id`='14')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-0RE-88LVR-S467' WHERE (`id`='17')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Z-Q4U-4RBY0-3L5M' WHERE (`id`='18')");

        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391E-VE8-IRIDF-L1G5' WHERE (`id`='19')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391T-C2B-3CMKV-C766' WHERE (`id`='39')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391E-KJ4-O1YGC-38MW' WHERE (`id`='20')");

        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?03917-J1S-CVWIQ-P7RM' WHERE (`id`='21')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391N-SDL-8MG5H-U6V1' WHERE (`id`='22')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391J-WAC-6HZ3A-KJPF' WHERE (`id`='23')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?03911-QXH-6AFX5-BUGV' WHERE (`id`='24')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391K-MD2-NBXU7-K7IB' WHERE (`id`='25')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-FMN-H6SSX-8UB6' WHERE (`id`='26')");

        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391R-NRX-RD4K1-AU22' WHERE (`id`='35')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391M-WSV-JDX4J-TP5G' WHERE (`id`='44')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Z-2XT-KR75K-NOS5' WHERE (`id`='45')");
        $this->execute("UPDATE `insurance_categories` SET `url`='http://diensten.voogd.com/portal/index.asp?0391Y-5Q7-AAYQZ-EUE8' WHERE (`id`='46')");
	}

	public function safeDown()
	{
	}

}