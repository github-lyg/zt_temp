<?php if (!defined("IN_IA")) {
    exit("Access Denied");
}
require(EWEI_SHOPV2_PLUGIN . "dividend/core/page_login_mobile.php");

class Ranking_EweiShopV2Page extends DividendMobileLoginPage
{
    public function main()
    {
        global $_W;

        $member = m("member")->getInfo($_W["openid"]);

        $amountRanking = pdo_fetchall("select sum(b.bonus) as amount,b.openid,m.nickname,m.avatar from " . tablename("ewei_shop_dividend_bonus") . " b " . " left join  " . tablename("ewei_shop_member") . " m on b.openid = m.openid" . " where b.uniacid = :uniacid GROUP BY b.openid ORDER BY amount DESC LIMIT 50", array(":uniacid" => $_W["uniacid"]));

        $totalRanking = pdo_fetchall("select count(h.id) as counts,h.headsid,m.nickname,m.avatar from " . tablename("ewei_shop_member") . " h " . " left join  " . tablename("ewei_shop_member") . " m on h.headsid = m.id" . " where h.uniacid = :uniacid and h.headsid>0 GROUP BY h.headsid ORDER BY counts DESC LIMIT 50", array(":uniacid" => $_W["uniacid"]));

        $memberInfo = [
            'nickname'      => $member['nickname'],
            'openid'        => $member['openid'],
            'mobile'        => $member['mobile'],
            'avatar'        => $member['avatar'],
            'amountRanking' => "暂未上榜",
            'totalRanking'  => "暂未上榜"
        ];

        foreach ($amountRanking as $key => $item) {
            if ($item['openid'] == $member['openid']) {
                $memberInfo['amountRanking'] = $key + 1;
            }
        }
        foreach ($totalRanking as $key => $item) {
            if ($item['headsid'] == $member['id']) {
                $memberInfo['totalRanking'] = $key + 1;
            }
        }
        //echo "<pre>"; print_r($member);exit;

        include($this->template());
    }

}

?>

