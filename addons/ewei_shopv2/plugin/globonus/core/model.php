<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

define('TM_GLOBONUS_PAY', 'TM_GLOBONUS_PAY');
define('TM_GLOBONUS_UPGRADE', 'TM_GLOBONUS_UPGRADE');
define('TM_GLOBONUS_BECOME', 'TM_GLOBONUS_BECOME');

if (!class_exists('GlobonusModel')) {
    class GlobonusModel extends PluginModel
    {
        public function getSet($uniacid = 0)
        {
            $set = parent::getSet($uniacid);
            $set['texts'] = array('partner' => empty($set['texts']['partner']) ? '股东' : $set['texts']['partner'], 'center' => empty($set['texts']['center']) ? '股东中心' : $set['texts']['center'], 'become' => empty($set['texts']['become']) ? '成为股东' : $set['texts']['become'], 'bonus' => empty($set['texts']['bonus']) ? '分红' : $set['texts']['bonus'], 'bonus_total' => empty($set['texts']['bonus_total']) ? '累计分红' : $set['texts']['bonus_total'], 'bonus_lock' => empty($set['texts']['bonus_lock']) ? '待结算分红' : $set['texts']['bonus_lock'], 'bonus_pay' => empty($set['texts']['bonus_lock']) ? '已结算分红' : $set['texts']['bonus_pay'], 'bonus_wait' => empty($set['texts']['bonus_wait']) ? '预计分红' : $set['texts']['bonus_wait'], 'bonus_detail' => empty($set['texts']['bonus_detail']) ? '分红明细' : $set['texts']['bonus_detail'], 'bonus_charge' => empty($set['texts']['bonus_charge']) ? '扣除提现手续费' : $set['texts']['bonus_charge']);
            return $set;
        }

        /**
         * 获取所有股东等级
         * @return type
         * @global type $_W
         */
        public function getLevels($all = true, $default = false)
        {
            global $_W;

            if ($all) {
                $levels = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid order by bonus asc', array(':uniacid' => $_W['uniacid']));
            } else {
                $levels = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and (ordermoney>0 or commissionmoney>0 or bonusmoney>0) order by bonus asc', array(':uniacid' => $_W['uniacid']));
            }

            if ($default) {
                $default = array('id' => '0', 'levelname' => empty($_S['globonus']['levelname']) ? '默认等级' : $_S['globonus']['levelname'], 'bonus' => $_W['shopset']['globonus']['bonus']);
                $levels = array_merge(array($default), $levels);
            }

            return $levels;
        }

        // 支付成功分红结算
        public function checkOrderFinish($orderId)
        {
            global $_W;
            $set = $this->getSet();

            //是否开启股东分红实时结算
            // echo "<pre>"; print_r($set); exit;
            if ($set['paytype'] == 3) {
                $ordermoney = 0;
                $bonusordermoney = 0;
                $bonusmoney = 0;

                $orders = pdo_fetchall('select id,openid,price,dispatchprice from ' . tablename('ewei_shop_order') . (' where uniacid=' . $_W['uniacid'] . ' and status=3 and isglobonus=0 and id=' . $orderId), array(), 'id');
                //如果订单不存在，不分红
                if (empty($orders)) {
                    return null;
                }
                $partners = pdo_fetchall('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . ('  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 '), array(':uniacid' => $_W['uniacid']));
                // 未设置则取全局分红
                foreach ($partners as &$p) {
                    if (empty($p['partnerlevel']) || $p['bonus'] == null) {
                        $p['bonus'] = floatval($set['bonus']);
                    }
                }
                unset($p);
                //    echo "<pre>"; print_r($partners); exit;

                foreach ($orders as $o) {
                    $orderBonusMoney = $o['price'] - $o['dispatchprice'];
                    $orderGoods = pdo_fetchall("select o.realprice,o.goodsid,o.orderid,o.total,g.costprice,g.no_globonus  from " . tablename("ewei_shop_order_goods") . " o " . " left join  " . tablename("ewei_shop_goods") . " g on o.goodsid = g.id" . " where o.uniacid=:uniacid and o.orderid=:orderid", array(":uniacid" => $_W["uniacid"], ":orderid" => $orderId));
                    // echo "<pre>"; print_r($orderGoods); exit;
                    foreach ($orderGoods as $key => $goods) {
                        //商品不参与分红
                        if ($goods['no_globonus'] == 1) {
                            $orderBonusMoney -= $goods['realprice'];
                        } //如果开启订单利润计算分红
                        elseif ($set['bonusType'] == 1) {
                            $orderBonusMoney -= $goods['costprice'] * $goods['total'];
                        }
                        $orderBonusMoney < 0 && $orderBonusMoney = 0;
                    }
                    // echo "<pre>"; print_r($orderBonusMoney); exit;
                    $ordermoney += $o['price'];
                    // echo "<pre>"; print_r($set); exit;

                    //分红金额计算 平台累计分红
                    // $bonusordermoney += $orderBonusMoney * $set['bonusrate'] / 100;

                    // echo "<pre>"; print_r($partners); exit;
                    $zerro = 0;
                    $five = 0;
                    $six = 0;
                    $seven= 0;
                    // 计算股东人数
                    foreach ($partners as $p) {
                        // 店长人数
                        if ($p['partnerlevel'] == '0') {
                            $zerro++;
                        }
                        // 经理人数
                        if ($p['partnerlevel'] == '5') {
                            $five++;
                        }
                        if ($p['partnerlevel'] == '6') {
                            $six++;
                        }
                        if ($p['partnerlevel'] == '7') {
                            $seven++;
                        }
                    }
                    //  echo "<pre>";
                    //  print_r($zerro);
                    //  print_r($five);
                    //  print_r($six);
                    //  print_r($seven);
                    //   exit;
                    // 应该分的利润
                    $price = $orderBonusMoney * $set['bonusrate'] / 100;
                    foreach ($partners as  $key=>$p) {
                        // 是否允许内购
                        if (empty($set['selfbuy'])) {
                            if ($p['openid'] == $o['openid']) {
                                continue;
                            }
                        }
                        !isset($p['bonusmoney']) && $p['bonusmoney'] = 0;
                        // 店长分红
                        if ($p['partnerlevel'] == '0') {
                            $p['bonusmoney'] += floatval($price * $p['bonus'] /100/ (count($partners)));
                        }
                        // 经理分红
                        if ($p['partnerlevel'] == '6') {
                            $p['bonusmoney'] += floatval($price * $p['bonus'] /100/ (count($partners)-$zerro));
                        }
                        // 总经理分红
                        if ($p['partnerlevel'] == '5') {
                            $p['bonusmoney'] += floatval($price * $p['bonus'] /100/ (count($partners)-$zerro-$six-$five));
                        }
                        // 高级经理分红
                        if ($p['partnerlevel'] == '7') {
                            $p['bonusmoney'] += floatval($price * $p['bonus'] /100/ (count($partners)-$zerro-$six));
                        }
                        $partners[$key]['bonusmoney'] = $p['bonusmoney'];
                    }
                    // echo "<pre>";print_r($partners);exit;

                    unset($p);
                    unset($ewei_shop_member);
                }
                //    echo "<pre>"; print_r($set['levelBonus']); exit;

                //增加是否开启等级比例分红
                // $levelBonus = [];
                // if ($set['levelBonus'] == 1) {
                //     $partnerLevels = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid ORDER BY hierarchy desc'), array(':uniacid' => $_W['uniacid']));
                //     // echo "<pre>"; print_r($partnerLevels); exit;
                //     //股东等级人数
                //     $countNum = 0;
                //     foreach ($partnerLevels as $key => $partnerLevel) {
                //         $num = pdo_fetchcolumn('select count(id) from' . tablename('ewei_shop_member') . (' where uniacid=' . $_W['uniacid'] . ' and ispartner = 1 and partnerstatus = 1 and partnerlevel=' . $partnerLevel['id'])) ?: 0;
                //         $countNum += $num;
                //         $levelBonus[$partnerLevel['id']] = [
                //             'num'       => $num,
                //             'bonusNum'  => $countNum,
                //             'bonusRate' => $partnerLevel['bonus']
                //         ];
                //     }
                  
                //     $partnerCount = pdo_fetchcolumn('select count(id) from' . tablename('ewei_shop_member') . (' where uniacid=' . $_W['uniacid'] . ' and ispartner = 1 and partnerstatus = 1')) ?: 0;
                //     // echo "<pre>"; print_r($partnerCount); exit;
                //     $levelBonus[0] = [
                //         'num'       => $partnerCount,
                //         'bonusNum'  => $partnerCount,
                //         'bonusRate' => $set['bonus']
                //     ];

                //     rsort($levelBonus);

                //     $bonusMoney = 0;
                //     foreach ($levelBonus as $key => &$bonus) {
                //         $money = round($bonusordermoney * $bonus['bonusRate'] / 100 / $bonus['bonusNum'], 2);

                //         $bonusMoney += $money;

                //         //等级应分红份额
                //         $bonus['bonusMoney'] = $bonusMoney;
                //     }
                //     // echo "<pre>";print_r($bonus);exit;
                // }
                //    echo "<pre>";print_r($levelBonus);exit;
                // echo "<pre>";print_r($partners);exit;
                foreach ($partners as &$p) {
                    $bonusmoney_send = 0;
                    $p['charge'] = 0;
                    $p['chargemoney'] = 0;
                    //开启等级比例分红
                    // if ($set['levelBonus'] == 1) {
                    //     $p['bonusmoney'] = $levelBonus[$p['partnerlevel']]['bonusMoney'];
                    // }

                    if (floatval($set['paycharge']) <= 0 || floatval($set['paybegin']) <= $p['bonusmoney'] && $p['bonusmoney'] <= floatval($set['payend'])) {
                        $bonusmoney_send += round($p['bonusmoney'], 2);
                    } else {
                        $bonusmoney_send += round($p['bonusmoney'] - $p['bonusmoney'] * floatval($set['paycharge']) / 100, 2);
                        $p['charge'] = floatval($set['paycharge']);
                        $p['chargemoney'] = round($p['bonusmoney'] * floatval($set['paycharge']) / 100, 2);
                    }

                    $p['bonusmoney_send'] = $bonusmoney_send;
                    // 分红总数
                    $bonusmoney += $bonusmoney_send;
//                    echo "<pre>";print_r($bonusmoney);
                }
                
                unset($p);
                // echo "<pre>"; print_r($partners); exit;
                // echo "<pre>"; print_r($bonusordermoney); exit;

                if ($bonusordermoney < $bonusmoney) {
                    $rat = $bonusordermoney / $bonusmoney;
                    $bonusmoney = 0;

                    foreach ($partners as &$p) {
                        $p['chargemoney'] = round($p['chargemoney'] * $rat, 2);
                        $p['bonusmoney_send'] = round($p['bonusmoney_send'] * $rat, 2);

                        $bonusmoney += $p['bonusmoney_send'];
                    }
                    unset($p);
                }
//                echo "<pre>";print_r($bonusmoney);
//                echo "<pre>";print_r($levelBonus);
//                echo "<pre>";print_r($partners);exit;


                $data = array(
                    'orders'          => $orders,
                    'partners'        => $partners,
                    'ordermoney'      => round($ordermoney, 2),
                    'bonusordermoney' => round($bonusordermoney, 2),
                    'bonusrate'       => round($set['bonusrate'], 2),
                    'ordercount'      => count($orders),
                    'bonusmoney'      => round($bonusmoney, 2),
                    'partnercount'    => count($partners),
                    'starttime'       => 0,
                    'endtime'         => 0,
                    'old'             => false
                );
                // echo "<pre>"; print_r($data); exit;
                //前段修改的分红最终值，这里直接赋值
                $bonusmoney = $data['bonusordermoney'];
                // echo "<pre>"; print_r($data['orders']); exit;

                $bill = array(
                    'uniacid'         => $_W['uniacid'],
                    'billno'          => m('common')->createNO('globonus_bill', 'billno', 'GB'),
                    'paytype'         => $set['paytype'],
                    'year'            => 0,
                    'month'           => 0,
                    'week'            => 0,
                    'ordercount'      => $data['ordercount'],
                    'ordermoney'      => $data['ordermoney'],
                    'bonusmoney'      => $data['bonusmoney'],
                    'bonusordermoney' => $data['bonusordermoney'],
                    'bonusrate'       => $data['bonusrate'],
                    'bonusmoney_send' => $bonusmoney,
                    'bonusmoney_pay'  => $bonusmoney,
                    'partnercount'    => $data['partnercount'],
                    'starttime'       => $data['starttime'],
                    'endtime'         => $data['endtime'],
                    'createtime'      => time(),
                    'confirmtime'     => time(),
                    'status'          => 2
                );

                pdo_insert('ewei_shop_globonus_bill', $bill);
                $billid = pdo_insertid();
               
                foreach ($data['orders'] as $order) {
                    $bo = array(
                        'uniacid'    => $_W['uniacid'],
                        'billid'     => $billid,
                        'orderid'    => $order['id'],
                        'ordermoney' => $order['price']
                    );
                    pdo_insert('ewei_shop_globonus_billo', $bo);
                    $inserID = pdo_insertid();
                    if ($inserID) {
                        pdo_update('ewei_shop_order', array('isglobonus' => '1'), array('id' => $order['id']));
                    }
                    // echo "<pre>"; print_r($order['id']); exit;
                }
                
                // $rate = $bonusmoney / $data['bonusmoney'];

                // echo "<pre>"; print_r($rate); exit;
                // logg('1.json',$data['partners']);
                foreach ($data['partners'] as $partner) {
                    $bp = array(
                        'uniacid'     => $_W['uniacid'],
                        'billid'      => $billid,
                        'payno'       => m('common')->createNO('globonus_billp', 'payno', 'GP'),
                        'openid'      => $partner['openid'],
                        'money'       => $partner['bonusmoney'],
//                        'realmoney'   => $partner['bonusmoney_send'] * $rate,
//                        'paymoney'    => $partner['bonusmoney_send'] * $rate,
                        'realmoney'   => $partner['bonusmoney_send'],
                        'paymoney'    => $partner['bonusmoney_send'],
                        'bonus'       => $partner['bonus'],
                        'charge'      => $partner['charge'],
                        'chargemoney' => $partner['chargemoney'],
                        'status'      => 1
                    );
                    pdo_insert('ewei_shop_globonus_billp', $bp);
                }
                plog('globonus.bonus.build', '实时创建结算单 ID:' . $billid . ' 单号: ' . $bill['billno'] . ' 分红金额: ' . $bill['bonusmoney_pay'] . ' 股东人数:  ' . $bill['partnercount']);


                //自动结算
                $partners = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_billp') . ' where billid=:billid and status=1 and uniacid=:uniacid', array(':uniacid' => $_W['uniacid'], ':billid' => $billid), 'id');
                //   echo "<pre>"; print_r($billid); exit;
                foreach ($partners as $partner) {
                    $pay = $partner['paymoney'];
                    $moneytype = intval($set['moneytype']);
                    $moneytype <= 0 && ($moneytype = 0);

                    if ($pay < 1) {
                        $moneytype = 0;
                    }

                    $member = m('member')->getMember($partner['openid']);

                    if (!empty($member)) {

                        //会员冻结分红值 + 本次分红值
                        $memberPartnerBonus = $member['partner_froze_amount'] + $pay;

                        //股东等级
                        $memberPartnerLevel = pdo_fetch('select *  from ' . tablename('ewei_shop_globonus_level') . ' where id=:id and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $member['partnerlevel']));
                        //股东等级等级冻结金额
                        $levelFetter = $memberPartnerLevel ? $memberPartnerLevel['froze_amount'] : ($set['froze_amount'] ?: 0);

                        //应分红金额，大于0直接分红，小于0累加到会员冻结分红值
                        $payAmount = $memberPartnerBonus - abs($levelFetter);
                        // logg('1.json',$memberPartnerBonus);
                        if ($payAmount > 0) {
                            if ($moneytype == 1) {
                                $pay = $payAmount * 100;
                            }
                            pdo_update('ewei_shop_member', array('partner_froze_amount' => $levelFetter), array('id' => $member['id']));
                            $result = m('finance')->pay($partner['openid'], $moneytype, $pay, $partner['payno'], '股东分红', false);
                        } else {
                            pdo_update('ewei_shop_member', array('partner_froze_amount' => $memberPartnerBonus), array('id' => $member['id']));
                            $result = true;
                        }

                        if (is_error($result)) {
                            pdo_update('ewei_shop_globonus_billp', array('reason' => $result['message'], 'status' => -1), array('id' => $partner['id']));
                        } else {
                            pdo_update('ewei_shop_globonus_billp', array('reason' => '', 'status' => 1, 'paytime' => time()), array('id' => $partner['id']));
                            $this->upgradeLevelByBonus($partner['openid']);
                            $this->sendMessage($partner['openid'], array('money' => $partner['paymoney'], 'nickname' => $member['nickname'], 'type' => ($payAmount > 0) ? ($moneytype ? '微信钱包' : '余额') : "冻结分红"), TM_GLOBONUS_PAY);
                        }
                    } else {
                        pdo_update('ewei_shop_globonus_billp', array('reason' => '未找到会员', 'status' => -1), array('id' => $partner['id']));
                    }
                }
                plog('globonus.bonus.payp', '自动进行结算单结算 ID:' . $billid);
            }
            return true;
        }

        public function getBonus($openid = '', $params = array())
        {
            global $_W;
            $ret = array();

            if (in_array('ok', $params)) {
                $ret['ok'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_globonus_billp') . ' where openid=:openid and status=1 and uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
            }

            if (in_array('lock', $params)) {
                $billdData = pdo_fetchall('select id from ' . tablename('ewei_shop_globonus_bill') . ' where 1 and uniacid = ' . intval($_W['uniacid']));
                $id = '';

                if (!empty($billdData)) {
                    $ids = array();

                    foreach ($billdData as $v) {
                        $ids[] = $v['id'];
                    }

                    $id = implode(',', $ids);
                    $ret['lock'] = pdo_fetchcolumn('select ifnull(sum(paymoney),0) from ' . tablename('ewei_shop_globonus_billp') . ' where openid=:openid and status<>1 and uniacid=:uniacid  and billid in(' . $id . ') limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                }
            }

            $ret['total'] = $ret['ok'] + $ret['lock'];
            return $ret;
        }

        /**
         * 消息通知
         * @param type $message_type
         * @param type $openid
         * @return type
         */
        public function sendMessage($openid = '', $data = array(), $message_type = '')
        {
            global $_W;
            global $_GPC;
            $set = $this->getSet();
            $tm = $set['tm'];
            $templateid = $tm['templateid'];
            $time = date('Y-m-d H:i:s', time());
            $member = m('member')->getMember($openid);
            $usernotice = unserialize($member['noticeset']);

            if (!is_array($usernotice)) {
                $usernotice = array();
            }

            if ($message_type == TM_GLOBONUS_PAY && empty($usernotice['globonus_pay'])) {
                if ($tm['is_advanced']) {
                    if ($tm['globonus_pay_close_advanced']) {
                        return false;
                    }

                    $tag = 'globonus_pay';
                    $text = '您的' . $set['texts']['bonus'] . "已打款！\n" . date('Y-m-d H:i') . "\n";
                    $message = array(
                        'first'    => array('value' => '亲爱的' . $member['nickname'] . '，您的' . $set['texts']['center'] . '的' . $set['texts']['bonus'] . '已打款', 'color' => '#ff0000'),
                        'keyword2' => array('title' => '业务状态', 'value' => '分红发放通知', 'color' => '#000000'),
                        'keyword3' => array('title' => '业务内容', 'value' => '您的分红打款成功', 'color' => '#000000'),
                        'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'),
                        'remark'   => array('value' => "\n感谢您的支持", 'color' => '#000000')
                    );
                    $toopenid = $openid;
                    $datas[] = array('name' => '昵称', 'value' => $member['nickname']);
                    $datas[] = array('name' => '时间', 'value' => $time);
                    $datas[] = array('name' => '金额', 'value' => $data['money']);
                    $datas[] = array('name' => '打款方式', 'value' => $data['type']);
                } else {
                    $message = $tm['pay'];

                    if (empty($message)) {
                        return false;
                    }

                    $message = str_replace('[昵称]', $member['nickname'], $message);
                    $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                    $message = str_replace('[金额]', $data['money'], $message);
                    $message = str_replace('[打款方式]', $data['type'], $message);
                    $msg = array(
                        'keyword1' => array('value' => '会员通知', 'color' => '#73a68d'),
                        'keyword2' => array('value' => !empty($tm['paytitle']) ? $tm['paytitle'] : '分红发放通知', 'color' => '#73a68d'),
                        'keyword3' => array('value' => $message, 'color' => '#73a68d')
                    );
                    return $this->sendNotice($openid, $tm, 'pay_advanced', $data, $member, $msg);
                }
            } else {
                if ($message_type == TM_GLOBONUS_UPGRADE && empty($usernotice['globonus_upgrade'])) {
                    if ($tm['is_advanced']) {
                        if ($tm['globonus_upgrade_close_advanced']) {
                            return false;
                        }

                        $tag = 'globonus_upgrade';
                        $text = '恭喜您成为' . $data['newlevel']['levelname'] . $set['texts']['partner'] . "！\n" . date('Y-m-d H:i') . "\n";
                        $message = array(
                            'first'    => array('value' => '亲爱的' . $member['nickname'] . '，恭喜您成为' . $data['newlevel']['levelname'] . $set['texts']['partner'], 'color' => '#ff0000'),
                            'keyword2' => array('title' => '业务状态', 'value' => '股东等级升级通知', 'color' => '#000000'),
                            'keyword3' => array('title' => '业务内容', 'value' => '您的股东等级从' . $data['oldlevel']['levelname'] . '升级到' . $data['newlevel']['levelname'] . ',特此通知！', 'color' => '#000000'),
                            'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'),
                            'remark'   => array('value' => "\n感谢您的支持", 'color' => '#000000')
                        );
                        $toopenid = $openid;
                        $datas[] = array('name' => '昵称', 'value' => $member['nickname']);
                        $datas[] = array('name' => '时间', 'value' => $time);
                        $datas[] = array('name' => '旧等级', 'value' => $data['oldlevel']['levelname']);
                        $datas[] = array('name' => '旧分红比例', 'value' => $data['oldlevel']['bonus'] . '%');
                        $datas[] = array('name' => '新等级', 'value' => $data['newlevel']['levelname']);
                        $datas[] = array('name' => '新分红比例', 'value' => $data['newlevel']['bonus'] . '%');
                    } else {
                        $message = $tm['upgrade'];

                        if (empty($message)) {
                            return false;
                        }

                        $message = str_replace('[昵称]', $member['nickname'], $message);
                        $message = str_replace('[时间]', date('Y-m-d H:i:s', time()), $message);
                        $message = str_replace('[旧等级]', $data['oldlevel']['levelname'], $message);
                        $message = str_replace('[旧分红比例]', $data['oldlevel']['bonus'] . '%', $message);
                        $message = str_replace('[新等级]', $data['newlevel']['levelname'], $message);
                        $message = str_replace('[新分红比例]', $data['newlevel']['bonus'] . '%', $message);
                        $msg = array(
                            'keyword1' => array('value' => '会员通知', 'color' => '#73a68d'),
                            'keyword2' => array('value' => !empty($tm['upgradetitle']) ? $tm['upgradetitle'] : '股东等级升级通知', 'color' => '#73a68d'),
                            'keyword3' => array('value' => $message, 'color' => '#73a68d')
                        );
                        return $this->sendNotice($openid, $tm, 'upgrade_advanced', $data, $member, $msg);
                    }
                } else {
                    if ($message_type == TM_GLOBONUS_BECOME && empty($usernotice['globonus_become'])) {
                        if ($tm['is_advanced']) {
                            if ($tm['globonus_become_close_advanced']) {
                                return false;
                            }

                            $tag = 'globonus_become';
                            $text = '恭喜您成为' . $set['texts']['center'] . "的股东！\n" . date('Y-m-d H:i') . "\n";
                            $message = array(
                                'first'    => array('value' => '亲爱的' . $member['nickname'] . '，恭喜您成为' . $set['texts']['center'] . '的股东', 'color' => '#ff0000'),
                                'keyword2' => array('title' => '业务状态', 'value' => '成为股东通知', 'color' => '#000000'),
                                'keyword3' => array('title' => '业务内容', 'value' => '恭喜您成为股东', 'color' => '#000000'),
                                'keyword1' => array('title' => '业务类型', 'value' => '会员通知', 'color' => '#000000'),
                                'remark'   => array('value' => "\n感谢您的支持", 'color' => '#000000')
                            );
                            $toopenid = $openid;
                            $datas[] = array('name' => '昵称', 'value' => $member['nickname']);
                            $datas[] = array('name' => '时间', 'value' => $time);
                        } else {
                            $message = $tm['become'];

                            if (empty($message)) {
                                return false;
                            }

                            $message = str_replace('[昵称]', $data['nickname'], $message);
                            $message = str_replace('[时间]', date('Y-m-d H:i:s', $data['partnertime']), $message);
                            $msg = array(
                                'keyword1' => array('value' => '会员通知', 'color' => '#73a68d'),
                                'keyword2' => array('value' => !empty($tm['becometitle']) ? $tm['becometitle'] : '成为股东通知', 'color' => '#73a68d'),
                                'keyword3' => array('value' => $message, 'color' => '#73a68d')
                            );
                            return $this->sendNotice($openid, $tm, 'become_advanced', $data, $member, $msg);
                        }
                    }
                }
            }

            m('notice')->sendNotice(array('openid' => $toopenid, 'tag' => $tag, 'default' => $message, 'cusdefault' => $text, 'datas' => $datas, 'plugin' => 'globonus'));
        }

        protected function sendNotice($touser, $tm, $tag, $datas, $member, $msg)
        {
            global $_W;
            if (!empty($tm['is_advanced']) && !empty($tm[$tag])) {
                $advanced_template = pdo_fetch('select * from ' . tablename('ewei_shop_member_message_template') . ' where id=:id and uniacid=:uniacid limit 1', array(':id' => $tm[$tag], ':uniacid' => $_W['uniacid']));

                if (!empty($advanced_template)) {
                    $url = !empty($advanced_template['url']) ? $this->replaceTemplate($advanced_template['url'], $tag, $datas, $member) : '';
                    $advanced_message = array(
                        'first'  => array('value' => $this->replaceTemplate($advanced_template['first'], $tag, $datas, $member), 'color' => $advanced_template['firstcolor']),
                        'remark' => array('value' => $this->replaceTemplate($advanced_template['remark'], $tag, $datas, $member), 'color' => $advanced_template['remarkcolor'])
                    );
                    $data = iunserializer($advanced_template['data']);

                    foreach ($data as $d) {
                        $advanced_message[$d['keywords']] = array('value' => $this->replaceTemplate($d['value'], $tag, $datas, $member), 'color' => $d['color']);
                    }

                    if (!empty($advanced_template['template_id'])) {
                        m('message')->sendTplNotice($touser, $advanced_template['template_id'], $advanced_message);
                    } else {
                        m('message')->sendCustomNotice($touser, $advanced_message);
                    }
                }
            } elseif (!empty($tm['templateid'])) {
                m('message')->sendTplNotice($touser, $tm['templateid'], $msg);
            } else {
                m('message')->sendCustomNotice($touser, $msg);
            }

            return true;
        }

        protected function replaceTemplate($str, $tag, $data, $member)
        {
            $arr = array('[昵称]' => $member['nickname'], '[时间]' => date('Y-m-d H:i:s', time()), '[金额]' => !empty($data['bonus']) ? $data['bonus'] : '', '[提现方式]' => !empty($data['type']) ? $data['type'] : '', '[旧等级]' => !empty($data['oldlevel']['levelname']) ? $data['oldlevel']['levelname'] : '', '[旧等级分红比例]' => !empty($data['oldlevel']['bonus']) ? $data['oldlevel']['bonus'] . '%' : '', '[新等级]' => !empty($data['newlevel']['levelname']) ? $data['newlevel']['levelname'] : '', '[新等级分红比例]' => !empty($data['newlevel']['bonus']) ? $data['newlevel']['bonus'] . '%' : '');

            switch ($tag) {
                case 'become_advanced':
                    $arr['[时间]'] = date('Y-m-d H:i:s', $data['partnertime']);
                    $arr['[昵称]'] = $data['nickname'];
                    // no break
                case 'pay_advanced':
                    $arr['[时间]'] = date('Y-m-d H:i:s', $data['paytime']);
                    $arr['[昵称]'] = $data['nickname'];
                    break;
            }

            foreach ($arr as $key => $value) {
                $str = str_replace($key, $value, $str);
            }

            return $str;
        }

        public function getLevel($openid)
        {
            global $_W;

            if (empty($openid)) {
                return false;
            }

            $member = m('member')->getMember($openid);

            if (empty($member['partnerlevel'])) {
                return false;
            }

            $level = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . ' where uniacid=:uniacid and id=:id limit 1', array(':uniacid' => $_W['uniacid'], ':id' => $member['partnerlevel']));
            return $level;
        }

        /**
         * 股东升级(根据分销订单)
         * @param type $mid
         */
        public function upgradeLevelByOrder($openid)
        {
            global $_W;

            if (empty($openid)) {
                return false;
            }

            $set = $this->getSet();

            if (empty($set['open'])) {
                return false;
            }

            $m = m('member')->getMember($openid);

            if (empty($m)) {
                return null;
            }

            $leveltype = intval($set['leveltype']);
            if ($leveltype == 4 || $leveltype == 5) {
                if (!empty($m['partnernotupgrade'])) {
                    return null;
                }

                $oldlevel = $this->getLevel($m['openid']);

                if (empty($oldlevel['id'])) {
                    $oldlevel = array('levelname' => empty($set['levelname']) ? '普通股东' : $set['levelname'], 'bonus' => $set['bonus']);
                }

                $orders = pdo_fetch('select sum(og.realprice) as ordermoney,count(distinct og.orderid) as ordercount from ' . tablename('ewei_shop_order') . ' o ' . ' left join  ' . tablename('ewei_shop_order_goods') . ' og on og.orderid=o.id ' . ' where o.openid=:openid and o.status>=3 and o.uniacid=:uniacid limit 1', array(':uniacid' => $_W['uniacid'], ':openid' => $openid));
                $ordermoney = $orders['ordermoney'];
                $ordercount = $orders['ordercount'];

                if ($leveltype == 4) {
                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1'), array(':uniacid' => $_W['uniacid']));

                    if (empty($newlevel)) {
                        return null;
                    }

                    if (!empty($oldlevel['id'])) {
                        if ($oldlevel['id'] == $newlevel['id']) {
                            return null;
                        }

                        if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                            return null;
                        }
                    }
                } else {
                    if ($leveltype == 5) {
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1'), array(':uniacid' => $_W['uniacid']));

                        if (empty($newlevel)) {
                            return null;
                        }

                        if (!empty($oldlevel['id'])) {
                            if ($oldlevel['id'] == $newlevel['id']) {
                                return null;
                            }

                            if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                return null;
                            }
                        }
                    }
                }

                pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
                $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
            } else {
                if (0 <= $leveltype && $leveltype <= 3) {
                    $agents = array();

                    if (!empty($set['selfbuy'])) {
                        $agents[] = $m;
                    }

                    if (!empty($m['agentid'])) {
                        $m1 = m('member')->getMember($m['agentid']);

                        if (!empty($m1)) {
                            $agents[] = $m1;
                            if (!empty($m1['agentid']) && $m1['isagent'] == 1 && $m1['status'] == 1) {
                                $m2 = m('member')->getMember($m1['agentid']);
                                if (!empty($m2) && $m2['isagent'] == 1 && $m2['status'] == 1) {
                                    $agents[] = $m2;

                                    if (empty($set['selfbuy'])) {
                                        if (!empty($m2['agentid']) && $m2['isagent'] == 1 && $m2['status'] == 1) {
                                            $m3 = m('member')->getMember($m2['agentid']);
                                            if (!empty($m3) && $m3['isagent'] == 1 && $m3['status'] == 1) {
                                                $agents[] = $m3;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }

                    if (empty($agents)) {
                        return null;
                    }

                    foreach ($agents as $agent) {
                        $info = $this->getInfo($agent['id'], array('ordercount3', 'ordermoney3', 'order13money', 'order13'));

                        if (!empty($info['partnernotupgrade'])) {
                            continue;
                        }

                        $oldlevel = $this->getLevel($agent['openid']);

                        if (empty($oldlevel['id'])) {
                            $oldlevel = array('levelname' => empty($set['levelname']) ? '普通股东' : $set['levelname'], 'bonus' => $set['bonus']);
                        }

                        if ($leveltype == 0) {
                            $ordermoney = $info['ordermoney3'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1'), array(':uniacid' => $_W['uniacid']));

                            if (empty($newlevel)) {
                                continue;
                            }

                            if (!empty($oldlevel['id'])) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    continue;
                                }

                                if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                    continue;
                                }
                            }
                        } elseif ($leveltype == 1) {
                            $ordermoney = $info['order13money'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid and ' . $ordermoney . ' >= ordermoney and ordermoney>0  order by ordermoney desc limit 1'), array(':uniacid' => $_W['uniacid']));

                            if (empty($newlevel)) {
                                continue;
                            }

                            if (!empty($oldlevel['id'])) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    continue;
                                }

                                if ($newlevel['ordermoney'] < $oldlevel['ordermoney']) {
                                    continue;
                                }
                            }
                        } elseif ($leveltype == 2) {
                            $ordercount = $info['ordercount3'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1'), array(':uniacid' => $_W['uniacid']));

                            if (empty($newlevel)) {
                                continue;
                            }

                            if (!empty($oldlevel['id'])) {
                                if ($oldlevel['id'] == $newlevel['id']) {
                                    continue;
                                }

                                if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                    continue;
                                }
                            }
                        } else {
                            if ($leveltype == 3) {
                                $ordercount = $info['order13'];
                                $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $ordercount . ' >= ordercount and ordercount>0  order by ordercount desc limit 1'), array(':uniacid' => $_W['uniacid']));

                                if (empty($newlevel)) {
                                    continue;
                                }

                                if (!empty($oldlevel['id'])) {
                                    if ($oldlevel['id'] == $newlevel['id']) {
                                        continue;
                                    }

                                    if ($newlevel['ordercount'] < $oldlevel['ordercount']) {
                                        continue;
                                    }
                                }
                            }
                        }

                        pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $agent['id']));
                        $this->sendMessage($agent['openid'], array('nickname' => $agent['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
                    }
                }
            }
        }

        public function getInfo($openid, $options = null)
        {
            $return = array();

            if (p('commission')) {
                return p('commission')->getInfo($openid, $options);
            }

            return $return;
        }

        /**
         * 股东升级(根据下级数)
         * @param type $mid
         */
        public function upgradeLevelByAgent($openid)
        {
            global $_W;

            if (empty($openid)) {
                return false;
            }

            $set = $this->getSet();

            if (empty($set['open'])) {
                return false;
            }

            $m = m('member')->getMember($openid);

            if (empty($m)) {
                return null;
            }

            $leveltype = intval($set['leveltype']);
            if ($leveltype < 6 || 9 < $leveltype) {
                return null;
            }

            $info = $this->getInfo($m['id'], array());
            if ($leveltype == 6 || $leveltype == 8) {
                $agents = array($m);

                if (!empty($m['agentid'])) {
                    $m1 = m('member')->getMember($m['agentid']);

                    if (!empty($m1)) {
                        $agents[] = $m1;
                        if (!empty($m1['agentid']) && $m1['isagent'] == 1 && $m1['status'] == 1) {
                            $m2 = m('member')->getMember($m1['agentid']);
                            if (!empty($m2) && $m2['isagent'] == 1 && $m2['status'] == 1) {
                                $agents[] = $m2;
                            }
                        }
                    }
                }

                if (empty($agents)) {
                    return null;
                }

                foreach ($agents as $agent) {
                    $info = $this->getInfo($agent['id'], array());

                    if (!empty($info['agentnotupgrade'])) {
                        continue;
                    }

                    $oldlevel = $this->getLevel($agent['openid']);

                    if (empty($oldlevel['id'])) {
                        $oldlevel = array('levelname' => empty($set['levelname']) ? '普通股东' : $set['levelname'], 'bonus' => $set['bonus']);
                    }

                    if ($leveltype == 6) {
                        $downs1 = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and uniacid=:uniacid ', array(':agentid' => $m['id'], ':uniacid' => $_W['uniacid']), 'id');
                        $downcount += count($downs1);

                        if (!empty($downs1)) {
                            $downs2 = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($downs1)) . ') and uniacid=:uniacid', array(':uniacid' => $_W['uniacid']), 'id');
                            $downcount += count($downs2);

                            if (!empty($downs2)) {
                                $downs3 = pdo_fetchall('select id from ' . tablename('ewei_shop_member') . ' where agentid in( ' . implode(',', array_keys($downs2)) . ') and uniacid=:uniacid', array(':uniacid' => $_W['uniacid']), 'id');
                                $downcount += count($downs3);
                            }
                        }

                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $downcount . ' >= downcount and downcount>0  order by downcount desc limit 1'), array(':uniacid' => $_W['uniacid']));
                    } else {
                        if ($leveltype == 8) {
                            $downcount = $info['level1'] + $info['level2'] + $info['level3'];
                            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $downcount . ' >= downcount and downcount>0  order by downcount desc limit 1'), array(':uniacid' => $_W['uniacid']));
                        }
                    }

                    if (empty($newlevel)) {
                        continue;
                    }

                    if ($newlevel['id'] == $oldlevel['id']) {
                        continue;
                    }

                    if (!empty($oldlevel['id'])) {
                        if ($newlevel['downcount'] < $oldlevel['downcount']) {
                            continue;
                        }
                    }

                    pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $agent['id']));
                    $this->sendMessage($agent['openid'], array('nickname' => $agent['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
                }
            } else {
                if (!empty($m['parnternotupgrade'])) {
                    return null;
                }

                $oldlevel = $this->getLevel($m['openid']);

                if (empty($oldlevel['id'])) {
                    $oldlevel = array('levelname' => empty($set['levelname']) ? '普通股东' : $set['levelname'], 'bonus' => $set['bonus']);
                }

                if ($leveltype == 7) {
                    $downcount = pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_member') . ' where agentid=:agentid and uniacid=:uniacid ', array(':agentid' => $m['id'], ':uniacid' => $_W['uniacid']));
                    $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $downcount . ' >= downcount and downcount>0  order by downcount desc limit 1'), array(':uniacid' => $_W['uniacid']));
                } else {
                    if ($leveltype == 9) {
                        $downcount = $info['level1'];
                        $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $downcount . ' >= downcount and downcount>0  order by downcount desc limit 1'), array(':uniacid' => $_W['uniacid']));
                    }
                }

                if (empty($newlevel)) {
                    return null;
                }

                if ($newlevel['id'] == $oldlevel['id']) {
                    return null;
                }

                if (!empty($oldlevel['id'])) {
                    if ($newlevel['downcount'] < $oldlevel['downcount']) {
                        return null;
                    }
                }

                pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
                $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
            }
        }

        /**
         * 分销商升级(根据佣金数)
         * @param type $mid
         */
        public function upgradeLevelByCommissionOK($openid)
        {
            global $_W;

            if (empty($openid)) {
                return false;
            }

            $set = $this->getSet();

            if (empty($set['open'])) {
                return false;
            }

            $m = m('member')->getMember($openid);

            if (empty($m)) {
                return null;
            }

            $leveltype = intval($set['leveltype']);

            if ($leveltype != 10) {
                return null;
            }

            if (!empty($m['partnernotupgrade'])) {
                return null;
            }

            $oldlevel = $this->getLevel($m['openid']);

            if (empty($oldlevel['id'])) {
                $oldlevel = array('levelname' => empty($set['levelname']) ? '普通股东' : $set['levelname'], 'bonus' => $set['bonus']);
            }

            $info = $this->getInfo($m['id'], array('pay'));
            $commissionmoney = $info['commission_pay'];
            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $commissionmoney . ' >= commissionmoney and commissionmoney>0  order by commissionmoney desc limit 1'), array(':uniacid' => $_W['uniacid']));

            if (empty($newlevel)) {
                return null;
            }

            if ($oldlevel['id'] == $newlevel['id']) {
                return null;
            }

            if (!empty($oldlevel['id'])) {
                if ($newlevel['commissionmoney'] < $oldlevel['commissionmoney']) {
                    return null;
                }
            }

            pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
            $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
        }

        /**
         * 股东升级(根据分红数)
         * @param type $mid
         */
        public function upgradeLevelByBonus($openid)
        {
            global $_W;

            if (empty($openid)) {
                return false;
            }

            $set = $this->getSet();

            if (empty($set['open'])) {
                return false;
            }

            $m = m('member')->getMember($openid);

            if (empty($m)) {
                return null;
            }

            $leveltype = intval($set['leveltype']);

            if ($leveltype != 11) {
                return null;
            }

            if (!empty($m['agentnotupgrade'])) {
                return null;
            }

            $oldlevel = $this->getLevel($m['openid']);

            if (empty($oldlevel['id'])) {
                $oldlevel = array('levelname' => empty($set['levelname']) ? '默认等级' : $set['levelname'], 'bonus' => $set['bonus']);
            }

            $bonusmoney = $this->getBonus($openid, array('ok'));
            $newlevel = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid  and ' . $bonusmoney['ok'] . ' >= bonusmoney and bonusmoney>0  order by bonusmoney desc limit 1'), array(':uniacid' => $_W['uniacid']));

            if (empty($newlevel)) {
                return null;
            }

            if ($oldlevel['id'] == $newlevel['id']) {
                return null;
            }

            if (!empty($oldlevel['id'])) {
                if ($newlevel['bonusmoney'] < $oldlevel['bonusmoney']) {
                    return null;
                }
            }

            pdo_update('ewei_shop_member', array('partnerlevel' => $newlevel['id']), array('id' => $m['id']));
            $this->sendMessage($m['openid'], array('nickname' => $m['nickname'], 'oldlevel' => $oldlevel, 'newlevel' => $newlevel), TM_GLOBONUS_UPGRADE);
        }

        public function getBonusData($year = 0, $month = 0, $week = 0, $openid = '', $orderId = '')
        {
            global $_W;
            $set = $this->getSet();
            if (empty($set['bonusrate']) || $set['bonusrate'] <= 0) {
                $set['bonusrate'] = 100;
            }

            $days = get_last_day($year, $month);
            $starttime = strtotime($year . '-' . $month . '-1');
            $endtime = strtotime($year . '-' . $month . '-' . $days);
            $settletimes = intval($set['settledays']) * 86400;
            if (1 <= $week && $week <= 4) {
                $weekdays = array();
                $i = $starttime;

                while ($i <= $endtime) {
                    $ds = explode('-', date('Y-m-d', $i));
                    $day = intval($ds[2]);
                    $w = ceil($day / 7);

                    if (4 < $w) {
                        $w = 4;
                    }

                    if ($week == $w) {
                        $weekdays[] = $i;
                    }

                    $i += 86400;
                }

                $starttime = $weekdays[0];
                $endtime = strtotime(date('Y-m-d', $weekdays[count($weekdays) - 1]) . ' 23:59:59');
            } else {
                $endtime = strtotime($year . '-' . $month . '-' . $days . ' 23:59:59');
            }

            $bill = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and `year`=:year and `month`=:month and `week`=:week limit 1', array(':uniacid' => $_W['uniacid'], ':year' => $year, ':month' => $month, ':week' => $week));
            if (!empty($bill) && empty($openid)) {
                return array(
                    'ordermoney'      => round($bill['ordermoney'], 2),
                    'ordercount'      => $bill['ordercount'],
                    'bonusmoney'      => round($bill['bonusmoney'], 2),
                    'bonusordermoney' => round($bill['bonusordermoney'], 2),
                    'bonusrate'       => round($bill['bonusrate'], 2),
                    'bonusmoney_send' => round($bill['bonusmoney_send'], 2),
                    'partnercount'    => $bill['partnercount'],
                    'starttime'       => $starttime,
                    'endtime'         => $endtime,
                    'billid'          => $bill['id'],
                    'old'             => true
                );
            }

            $ordermoney = 0;
            $bonusordermoney = 0;
            $bonusmoney = 0;
            $pcondition = '';

            if (!empty($openid)) {
                $member = m('member')->getMember($openid);
                $pcondition = 'AND finishtime>' . $member['partnertime'];
            }

            $orders = pdo_fetchall('select id,openid,price from ' . tablename('ewei_shop_order') . (' where uniacid=' . $_W['uniacid'] . ' and status=3 and isglobonus=0 and finishtime + ' . $settletimes . '>= ' . $starttime . ' and  finishtime + ' . $settletimes . '<=' . $endtime . ' ' . $pcondition), array(), 'id');
            $pcondition = '';

            if (!empty($openid)) {
                $pcondition = ' and m.openid=\'' . $openid . '\'';
            }

            $partners = pdo_fetchall('select m.id,m.openid,m.partnerlevel,l.bonus from ' . tablename('ewei_shop_member') . ' m ' . '  left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel ' . ('  where m.uniacid=:uniacid and  m.ispartner=1 and m.partnerstatus=1 ' . $pcondition), array(':uniacid' => $_W['uniacid']));

            foreach ($partners as &$p) {
                if (empty($p['partnerlevel']) || $p['bonus'] == null) {
                    $p['bonus'] = floatval($set['bonus']);
                }
            }

            unset($p);

            foreach ($orders as $o) {
                $orderBonusMoney = $o['price'];
                $orderGoods = pdo_fetchall("select o.realprice,o.goodsid,o.orderid,o.total,g.costprice,g.no_globonus  from " . tablename("ewei_shop_order_goods") . " o " . " left join  " . tablename("ewei_shop_goods") . " g on o.goodsid = g.id" . " where o.uniacid=:uniacid and o.orderid=:orderid", array(":uniacid" => $_W["uniacid"], ":orderid" => $orderId));
                //echo "<pre>"; print_r($orderGoods); exit;
                foreach ($orderGoods as $key => $goods) {
                    //商品不参与分红
                    if ($goods['no_globonus'] == 1) {
                        $orderBonusMoney -= $goods['realprice'];
                    } //如果开启订单利润计算分红
                    elseif ($set['bonusType'] == 1) {
                        $orderBonusMoney -= $goods['costprice'] * $goods['total'];
                    }
                    $orderBonusMoney < 0 && $orderBonusMoney = 0;
                }

                $ordermoney += $o['price'];
                //分红金额计算
                $bonusordermoney += $orderBonusMoney * $set['bonusrate'] / 100;

                foreach ($partners as &$p) {
                    if (empty($set['selfbuy'])) {
                        if ($p['openid'] == $o['openid']) {
                            continue;
                        }
                    }

                    $price = $orderBonusMoney * $set['bonusrate'] / 100;
                    !isset($p['bonusmoney']) && $p['bonusmoney'] = 0;
                    $p['bonusmoney'] += floatval($price * $p['bonus'] / 100);
                }
                unset($p);
                unset($orderBonusMoney);
            }

            //增加是否开启等级比例分红
            $levelBonus = [];
            if ($set['levelBonus'] == 1) {
                $partnerLevels = pdo_fetchall('select * from ' . tablename('ewei_shop_globonus_level') . (' where uniacid=:uniacid ORDER BY hierarchy desc'), array(':uniacid' => $_W['uniacid']));
                //股东等级人数
                $countNum = 0;
                foreach ($partnerLevels as $key => $partnerLevel) {
                    $num = pdo_fetchcolumn('select count(id) from' . tablename('ewei_shop_member') . (' where uniacid=' . $_W['uniacid'] . ' and ispartner = 1 and partnerstatus = 1 and partnerlevel=' . $partnerLevel['id'])) ?: 0;
                    $countNum += $num;
                    $levelBonus[$partnerLevel['id']] = [
                        'num'       => $num,
                        'bonusNum'  => $countNum,
                        'bonusRate' => $partnerLevel['bonus']
                    ];
                }
                $partnerCount = pdo_fetchcolumn('select count(id) from' . tablename('ewei_shop_member') . (' where uniacid=' . $_W['uniacid'] . ' and ispartner = 1 and partnerstatus = 1')) ?: 0;
                $levelBonus[0] = [
                    'num'       => $partnerCount,
                    'bonusNum'  => $partnerCount,
                    'bonusRate' => $set['bonus']
                ];

                rsort($levelBonus);

                $bonusMoney = 0;
                foreach ($levelBonus as $key => &$bonus) {
                    $money = round($bonusordermoney * $bonus['bonusRate'] / 100 / $bonus['bonusNum'], 2);

                    $bonusMoney += $money;

                    //等级应分红份额
                    $bonus['bonusMoney'] = $bonusMoney;
                }
                //echo "<pre>";print_r($levelBonus);exit;
            }
//                echo "<pre>";print_r($levelBonus);exit;

            foreach ($partners as &$p) {
                $bonusmoney_send = 0;
                $p['charge'] = 0;
                $p['chargemoney'] = 0;
                //开启等级比例分红
                if ($set['levelBonus'] == 1) {
                    $p['bonusmoney_send'] = $levelBonus[$p['partnerlevel']]['bonusMoney'];
                }
                if (floatval($set['paycharge']) <= 0 || floatval($set['paybegin']) <= $p['bonusmoney'] && $p['bonusmoney'] <= floatval($set['payend'])) {
                    $bonusmoney_send += round($p['bonusmoney'], 2);
                } else {
                    $bonusmoney_send += round($p['bonusmoney'] - $p['bonusmoney'] * floatval($set['paycharge']) / 100, 2);
                    $p['charge'] = floatval($set['paycharge']);
                    $p['chargemoney'] = round($p['bonusmoney'] * floatval($set['paycharge']) / 100, 2);
                }

                $p['bonusmoney_send'] = $bonusmoney_send;
                $bonusmoney += $bonusmoney_send;
            }
            unset($p);

            if ($bonusordermoney < $bonusmoney) {
                $rat = $bonusordermoney / $bonusmoney;
                $bonusmoney = 0;

                foreach ($partners as &$p) {
                    $p['chargemoney'] = round($p['chargemoney'] * $rat, 2);
                    $p['bonusmoney_send'] = round($p['bonusmoney_send'] * $rat, 2);

                    $bonusmoney += $p['bonusmoney_send'];
                }
                unset($p);
            }

            return array(
                'orders'          => $orders,
                'partners'        => $partners,
                'ordermoney'      => round($ordermoney, 2),
                'bonusordermoney' => round($bonusordermoney, 2),
                'bonusrate'       => round($set['bonusrate'], 2),
                'ordercount'      => count($orders),
                'bonusmoney'      => round($bonusmoney, 2),
                'partnercount'    => count($partners),
                'starttime'       => $starttime,
                'endtime'         => $endtime,
                'old'             => false
            );
        }

        public function getTotals()
        {
            global $_W;
            return array('total0' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and status=0 limit 1', array(':uniacid' => $_W['uniacid'])), 'total1' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and status=1 limit 1', array(':uniacid' => $_W['uniacid'])), 'total2' => pdo_fetchcolumn('select count(*) from ' . tablename('ewei_shop_globonus_bill') . ' where uniacid=:uniacid and status=2  limit 1', array(':uniacid' => $_W['uniacid'])));
        }
    }
}
