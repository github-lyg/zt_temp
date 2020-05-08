<?php
if (!defined('IN_IA')) {
    exit('Access Denied');
}

class Statistics_EweiShopV2Page extends PluginWebPage
{
    public function main()
    {
        global $_W;
        global $_GPC;

        $pageSize = 15;
        $pageIndex = max(1, intval($_GPC['page']));

        $condition = ' and b.uniacid =:uniacid';
        $params = array(':uniacid' => $_W['uniacid']);

        //股东等级检索
        $partnerLevel = $_GPC['partnerLevel'];
        if ($partnerLevel != '') {
            $condition .= ' and m.partnerlevel = :partnerLevel';
            $params[':partnerLevel'] = $partnerLevel;

            //等级分红金额
            $shareholderLevelBonus = pdo_fetchcolumn('select sum(b.paymoney) from' . tablename('ewei_shop_globonus_billp') . ' b ' . ' left join ' . tablename('ewei_shop_member') . ' m on m.openid = b.openid and m.uniacid = b.uniacid' . ' left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel' . (' where 1 ' . $condition), $params) ?: 0;
        }
        //股东信息搜索
        $keyword = trim($_GPC['keyword']);
        if (!empty($keyword)) {
            $condition .= ' and (m.realname like :keyword or m.nickname like :keyword or m.mobile like :keyword)';
            $params[':keyword'] = '%' . $keyword . '%';
        }
        //结算状态检索
        if ($_GPC['status'] != '') {
            if ($_GPC['status'] == 1) {
                $condition .= ' and b.status=1';
            } else {
                $condition .= ' and b.status=0 or b.status=-1';
            }
        }
        //时间检索
        if (!empty($_GPC['time']['start']) && !empty($_GPC['time']['end'])) {
            $startTime = strtotime($_GPC['time']['start']);
            $endTime = strtotime($_GPC['time']['end']);
            $condition .= ' and b.paytime >= :startTime and b.paytime <= :endTime ';
            $params[':startTime'] = $startTime;
            $params[':endTime'] = $endTime;
        }


        //订单检索
        if ($_GPC['orderId'] != '') {
            $bill = pdo_fetch('select * from ' . tablename('ewei_shop_globonus_billo') . ' where uniacid=:uniacid and `orderid`=:orderid limit 1', array(':uniacid' => $_W['uniacid'], ':orderid' => $_GPC['orderId']));

            $billid = $bill['billid'] ?: '0';

            $condition .= ' and b.billid=' . $billid;

            //echo "<pre>"; print_r($bill); exit;
        }


        $sql = 'select b.*, m.nickname,m.avatar,m.realname,m.weixin,m.mobile,l.levelname,b.bonus,m.partnerlevel,m.id as mid,o.ordersn from ' . tablename('ewei_shop_globonus_billp') . ' b ' . ' left join ' . tablename('ewei_shop_globonus_billo') . ' bo on bo.billid = b.billid' . ' left join ' . tablename('ewei_shop_order') . ' o on o.id = bo.orderid' .  ' left join ' . tablename('ewei_shop_member') . ' m on m.openid = b.openid and m.uniacid = b.uniacid' . ' left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel' . (' where 1 ' . $condition . ' ORDER BY id desc ');

        //echo "<pre>"; print_r($sql); exit;
        if (empty($_GPC['export'])) {
            $sql .= ' limit ' . ($pageIndex - 1) * $pageSize . ',' . $pageSize;
        }
        $list = pdo_fetchall($sql, $params);
//        echo "<pre>"; print_r($list); exit;

        $listTotal = pdo_fetchcolumn('select count(b.id) from' . tablename('ewei_shop_globonus_billp') . ' b ' . ' left join ' . tablename('ewei_shop_member') . ' m on m.openid = b.openid and m.uniacid = b.uniacid' . ' left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel' . (' where 1 ' . $condition), $params);

        //导出Excel
        if ($_GPC['export'] == 1) {
            $this->export($list);
        }

        //等级分红金额
        if ($partnerLevel != '') {
            $shareholderLevelConditionBonus = pdo_fetchcolumn('select sum(b.paymoney) from' . tablename('ewei_shop_globonus_billp') . ' b ' . ' left join ' . tablename('ewei_shop_member') . ' m on m.openid = b.openid and m.uniacid = b.uniacid' . ' left join ' . tablename('ewei_shop_globonus_level') . ' l on l.id = m.partnerlevel' . (' where 1 ' . $condition), $params) ?: 0;
        }

        $errorBonus = $this->errorBonus();
        $successBonus = $this->successBonus();
        $orderAmount = $this->orderAmount();
        $orderBonusAmount = $this->orderBonusAmount();
        $shareholderTotal = $this->shareholderTotal();
        $bonusShareholderTotal = $this->bonusShareholderTotal();

        $page = pagination2($listTotal, $pageIndex, $pageSize);

        $set = $this->getSet();
        $levels = $this->model->getLevels();

        include $this->template('globonus/statistics/index');
    }

    /**
     * 分红成功累计金额
     *
     * @return float
     */
    private function successBonus()
    {
        global $_W;

        //paymoney
        return pdo_fetchcolumn('select sum(money) from' . tablename('ewei_shop_globonus_billp') . (' where uniacid=' . $_W['uniacid'] . ' and status = 1')) ?: 0;
    }

    /**
     * 分红失败金额
     *
     * @return float
     */
    private function errorBonus()
    {
        global $_W;

        return pdo_fetchcolumn('select sum(paymoney) from' . tablename('ewei_shop_globonus_billp') . (' where uniacid=' . $_W['uniacid'] . ' and status = -1')) ?: 0;
    }

    /**
     * 参与股东分红股东数量
     *
     * @return int
     */
    private function bonusShareholderTotal()
    {
        global $_W;

        return pdo_fetchcolumn('select count(id) from' . tablename('ewei_shop_member') . (' where uniacid=' . $_W['uniacid'] . ' and ispartner = 1 and partnerstatus = 1')) ?: 0;
    }

    /**
     * 股东总数量
     *
     * @return int
     */
    private function shareholderTotal()
    {
        global $_W;

        return pdo_fetchcolumn('select count(id) from' . tablename('ewei_shop_member') . (' where uniacid=' . $_W['uniacid'] . ' and ispartner = 1')) ?: 0;
    }

    /**
     * 已完成订单总金额
     *
     * @return float
     */
    private function orderAmount()
    {
        global $_W;

        return pdo_fetchcolumn('select sum(price) from' . tablename('ewei_shop_order') . (' where uniacid=' . $_W['uniacid'] . ' and status=3 and isglobonus=0')) ?: 0;
    }

    /**
     * 参与分红订单总金额
     *
     * @return float
     */
    private function orderBonusAmount()
    {
        global $_W;

        return pdo_fetchcolumn('select sum(ordermoney) from' . tablename('ewei_shop_globonus_billo') . (' where uniacid=' . $_W['uniacid'])) ?: 0;
    }

    /**
     * @param $list
     */
    private function export($list)
    {
        ca('globonus.statistics.export');
        plog('globonus.statistics.export', '导出股东分红明细数据');

        foreach ($list as &$row) {
            $row['paytime'] = empty($row['paytime']) ? '' : date('Y-m-d H:i', $row['paytime']);
            $row['createtime'] = empty($row['createtime']) ? '' : date('Y-m-d H:i', $row['createtime']);
            $row['levelname'] = !empty($row['levelname']) ? $row['levelname'] : (empty($set['levelname']) ? '默认等级' : $set['levelname']);
        }

        unset($row);
        m('excel')->export($list, array(
            'title'   => '导出股东分红明细数据',
            'columns' => array(
                array('title' => 'ID', 'field' => 'id', 'width' => 12),
                array('title' => '单号', 'field' => 'payno', 'width' => 12),
                array('title' => '昵称', 'field' => 'nickname', 'width' => 12),
                array('title' => '姓名', 'field' => 'realname', 'width' => 12),
                array('title' => '手机号', 'field' => 'mobile', 'width' => 12),
                array('title' => '微信号', 'field' => 'weixin', 'width' => 12),
                array('title' => 'openid', 'field' => 'openid', 'width' => 24),
                array('title' => '等级', 'field' => 'levelname', 'width' => 12),
                array('title' => '计算分红', 'field' => 'money', 'width' => 12),
                array('title' => '实际分红', 'field' => 'realmoney', 'width' => 12),
                array('title' => '最终分红', 'field' => 'paymoney', 'width' => 12),
                array('title' => '打款时间', 'field' => 'paytime', 'width' => 12)
            )
        ));
    }
}
