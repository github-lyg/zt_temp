<?php
pdo_query("

DROP TABLE IF EXISTS `ims_ewei_shop_exhelper_esheet`;
CREATE TABLE `ims_ewei_shop_exhelper_esheet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `express` varchar(50) DEFAULT '',
  `code` varchar(20) NOT NULL DEFAULT '',
  `datas` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('1', '顺丰', 'shunfeng', 'SF', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}i:1;a:4:{s:5:\"style\";s:9:\"三联210\";s:4:\"spec\";s:38:\"（宽100mm 高210mm 切点90/60/60）\";s:4:\"size\";s:3:\"210\";s:9:\"isdefault\";i:0;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('2', '百世快递', 'huitongkuaidi', 'HTKY', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:0;}i:1;a:4:{s:5:\"style\";s:9:\"二联183\";s:4:\"spec\";s:37:\"（宽100mm 高183mm 切点87/5/91）\";s:4:\"size\";s:3:\"183\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('3', '韵达', 'yunda', 'YD', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:0;}i:1;a:4:{s:5:\"style\";s:9:\"二联203\";s:4:\"spec\";s:36:\"（宽100mm 高203mm 切点152/51）\";s:4:\"size\";s:3:\"203\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('4', '申通', 'shentong', 'STO', 'a:2:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}i:1;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:35:\"（宽100mm 高150mm 切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:0;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('5', '圆通', 'yuantong', 'YTO', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('6', 'EMS', 'ems', 'EMS', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('7', '中通', 'zhongtong', 'ZTO', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('8', '德邦', 'debangwuliu', 'DBL', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联177\";s:4:\"spec\";s:34:\"（宽100mm高177mm切点107/70）\";s:4:\"size\";s:3:\"177\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('9', '优速', 'youshuwuliu', 'UC', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('10', '宅急送', 'zhaijisong', 'ZJS', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联120\";s:4:\"spec\";s:33:\"（宽100mm高116mm切点98/10）\";s:4:\"size\";s:3:\"120\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('11', '京东', 'jd', 'JD', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联110\";s:4:\"spec\";s:33:\"（宽100mm高110mm切点60/50）\";s:4:\"size\";s:3:\"110\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('12', '信丰', 'xinfengwuliu', 'XFEX', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('13', '全峰', 'quanfengkuaidi', 'QFKD', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('14', '跨越速运', 'kuayue', 'KYSY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联137\";s:4:\"spec\";s:34:\"（宽100mm高137mm切点101/36）\";s:4:\"size\";s:3:\"137\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('15', '安能', 'annengwuliu', 'ANE', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"三联180\";s:4:\"spec\";s:37:\"（宽100mm高180mm切点110/30/40）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('16', '快捷', 'kuaijiesudi', 'FAST', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('17', '国通', 'guotongkuaidi', 'GTO', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('18', '天天', 'tiantian', 'HHTT', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('19', '中铁快运', 'zhongtiekuaiyun', 'ZTKY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('20', '邮政快递包裹', 'youzhengguonei', 'YZPY', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联180\";s:4:\"spec\";s:34:\"（宽100mm高180mm切点110/70）\";s:4:\"size\";s:3:\"180\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('21', '邮政国内标快', 'youzhengguonei', 'YZBK', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('22', '全一快递', 'quanyikuaidi', 'UAPEX', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:32:\"（宽90mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}');
INSERT INTO `ims_ewei_shop_exhelper_esheet` VALUES ('23', '速尔快递', 'sue', 'SURE', 'a:1:{i:0;a:4:{s:5:\"style\";s:9:\"二联150\";s:4:\"spec\";s:33:\"（宽100mm高150mm切点90/60）\";s:4:\"size\";s:3:\"150\";s:9:\"isdefault\";i:1;}}');

DROP TABLE IF EXISTS `ims_ewei_shop_member_message_template_type`;
CREATE TABLE `ims_ewei_shop_member_message_template_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `typecode` varchar(255) DEFAULT NULL,
  `templatecode` varchar(255) DEFAULT NULL,
  `templateid` varchar(255) DEFAULT NULL,
  `templatename` varchar(255) DEFAULT NULL,
  `content` varchar(1000) DEFAULT NULL,
  `typegroup` varchar(255) DEFAULT '',
  `groupname` varchar(255) DEFAULT '',
  `showtotaladd` tinyint(1) DEFAULT '0',
  KEY `id` (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('1', '订单付款通知', 'saler_pay', 'OPENTM405584202', '', '订单付款通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}商品名称：{{keyword2.DATA}}商品数量：{{keyword3.DATA}}支付金额：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('2', '自提订单提交成功通知', 'carrier', 'OPENTM201594720', '', '订单付款通知', '{{first.DATA}}自提码：{{keyword1.DATA}}商品详情：{{keyword2.DATA}}提货地址：{{keyword3.DATA}}提货时间：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('3', '订单取消通知', 'cancel', 'OPENTM201764653', '', '订单关闭提醒', '{{first.DATA}}订单商品：{{keyword1.DATA}}订单编号：{{keyword2.DATA}}下单时间：{{keyword3.DATA}}订单金额：{{keyword4.DATA}}关闭时间：{{keyword5.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('4', '订单即将取消通知', 'willcancel', 'OPENTM201764653', '', '订单关闭提醒', '{{first.DATA}}订单商品：{{keyword1.DATA}}订单编号：{{keyword2.DATA}}下单时间：{{keyword3.DATA}}订单金额：{{keyword4.DATA}}关闭时间：{{keyword5.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('5', '订单支付成功通知', 'pay', 'OPENTM405584202', '', '订单支付通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}商品名称：{{keyword2.DATA}}商品数量：{{keyword3.DATA}}支付金额：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('6', '订单发货通知', 'send', 'OPENTM401874827', '', '订单发货通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}快递公司：{{keyword2.DATA}}快递单号：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('7', '自动发货通知(虚拟物品及卡密)', 'virtualsend', 'OPENTM207793687', '', '自动发货通知', '{{first.DATA}}商品名称：{{keyword1.DATA}}订单号：{{keyword2.DATA}}订单金额：{{keyword3.DATA}}卡密信息：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('8', '订单状态更新(修改收货地址)(修改价格)', 'orderstatus', 'TM00017', '', '订单付款通知', '{{first.DATA}}订单编号:{{OrderSn.DATA}}订单状态:{{OrderStatus.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('9', '退款成功通知', 'refund1', 'TM00430', '', '退款成功通知', '{{first.DATA}}退款金额：{{orderProductPrice.DATA}}商品详情：{{orderProductName.DATA}}订单编号：{{orderName.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('10', '换货成功通知', 'refund3', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('11', '退款申请驳回通知', 'refund2', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('12', '充值成功通知', 'recharge_ok', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('13', '提现成功通知', 'withdraw_ok', 'OPENTM207422808', '', '提现通知', '{{first.DATA}}申请提现金额：{{keyword1.DATA}}取提现手续费：{{keyword2.DATA}}实际到账金额：{{keyword3.DATA}}提现渠道：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('14', '会员升级通知(任务处理通知)', 'upgrade', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('15', '充值成功通知（后台管理员手动）', 'backrecharge_ok', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('16', '积分变动提醒', 'backpoint_ok', 'OPENTM207509450', '', '积分变动提醒', '{{first.DATA}}获得时间：{{keyword1.DATA}}获得积分：{{keyword2.DATA}}获得原因：{{keyword3.DATA}}当前积分：{{keyword4.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('17', '换货发货通知', 'refund4', 'OPENTM401874827', '', '订单发货通知', '{{first.DATA}}订单编号：{{keyword1.DATA}}快递公司：{{keyword2.DATA}}快递单号：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('18', '砍价活动通知', 'bargain_message', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'bargain', '砍价消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('19', '拼团活动通知', 'groups', null, null, null, null, 'groups', '拼团消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('20', '人人分销通知', 'commission', null, null, null, null, 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('21', '商品付款通知', 'saler_goodpay', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('22', '砍到底价通知', 'bargain_fprice', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'bargain', '砍价消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('23', '订单收货通知(卖家)', 'saler_finish', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('24', '余额兑换成功通知', 'exchange_balance', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'exchange', '兑换中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('25', '积分兑换成功通知', 'exchange_score', 'OPENTM207509450', '', '积分变动提醒', '{{first.DATA}}获得时间：{{keyword1.DATA}}获得积分：{{keyword2.DATA}}获得原因：{{keyword3.DATA}}当前积分：{{keyword4.DATA}}{{remark.DATA}}', 'exchange', '兑换中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('26', '兑换中心余额充值通知', 'exchange_recharge', 'OPENTM207727673', '', '充值成功提醒', '{{first.DATA}}充值金额：{{keyword1.DATA}}充值时间：{{keyword2.DATA}}账户余额：{{keyword3.DATA}}{{remark.DATA}}', 'exchange', '兑换中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('27', '游戏中心通知', 'lottery_get', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'lottery', '抽奖消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('35', '库存预警通知', 'saler_stockwarn', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('36', '卖家核销商品核销通知', 'o2o_sverify', 'OPENTM409521536', '', '核销成功提醒', '{{first.DATA}}核销项目：{{keyword1.DATA}}核销时间：{{keyword2.DATA}}核销门店：{{keyword3.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('37', '核销商品核销通知', 'o2o_bverify', 'OPENTM409521536', '', '核销成功提醒', '{{first.DATA}}核销项目：{{keyword1.DATA}}核销时间：{{keyword2.DATA}}核销门店：{{keyword3.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('38', '卖家商品预约通知', 'o2o_snorder', 'OPENTM202447657', '', '预约成功提醒', '{{first.DATA}}预约项目：{{keyword1.DATA}}预约时间：{{keyword2.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('39', '商品预约成功通知', 'o2o_bnorder', 'OPENTM202447657', '', '预约成功提醒', '{{first.DATA}}预约项目：{{keyword1.DATA}}预约时间：{{keyword2.DATA}}{{remark.DATA}}', 'o2o', 'O2O消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('42', '商品下单通知', 'saler_goodsubmit', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('50', '维权订单通知', 'saler_refund', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sys', '系统消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('43', '任务接取通知', 'task_pick', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('44', '任务进度通知', 'task_progress', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('45', '任务完成通知', 'task_finish', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('46', '任务海报接取通知', 'task_poster_pick', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('47', '任务海报进度通知', 'task_poster_progress', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('48', '任务海报完成通知', 'task_poster_finish', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('49', '任务海报扫描通知', 'task_poster_scan', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'task', '任务中心消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('52', '成为分销商通知', 'commission_become', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('53', '新增下线通知', 'commission_agent_new', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('54', '下级付款通知', 'commission_order_pay', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('55', '下级确认收货通知', 'commission_order_finish', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('56', '提现申请提交通知', 'commission_apply', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('57', '提现申请完成审核通知', 'commission_check', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('58', '佣金打款通知', 'commission_pay', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('59', '分销商等级升级通知', 'commission_upgrade', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('60', '成为股东通知', 'globonus_become', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'globonus', '股东消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('61', '股东等级升级通知', 'globonus_upgrade', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'globonus', '股东消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('62', '分红发放通知', 'globonus_pay', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'globonus', '股东消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('63', '奖励发放通知', 'article', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'article', '文章营销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('64', '成为区域代理通知', 'abonus_become', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('65', '省级代理等级升级通知', 'abonus_upgrade1', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('66', '市级代理等级升级通知', 'abonus_upgrade2', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('67', '区级代理等级升级通知', 'abonus_upgrade3', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('68', '区域代理分红发放通知', 'abonus_pay', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'abonus', '区域代理消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('69', '入驻申请通知', 'merch_apply', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'merch', '商家通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('70', '提现申请提交通知', 'merch_applymoney', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'merch', '商家通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('71', '社区会员评论通知', 'reply', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sns', '人人社区消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('51', '社区会员升级通知', 'sns', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'sns', '人人社区消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('74', '周期购定时发货通知', 'cycelbuy_timing', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('73', '修改收货时间卖家通知', 'cycelbuy_seller_date', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('72', '修改地址卖家通知', 'cycelbuy_seller_address', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('75', '修改收货时间买家通知', 'cycelbuy_buyer_date', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('76', '修改地址买家通知', 'cycelbuy_buyer_address', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'cycelbuy', '周期购消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('77', '分销提现申请提醒', 'commission_applymoney', 'OPENTM207574677', null, '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'commission', '分销消息通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('80', '成为团长通知', 'dividend_become', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('81', '成为团长通知(卖家)', 'dividend_become_saler', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('82', '团员成为团长通知', 'dividend_downline_become', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('83', '团长提现通知', 'dividend_apply', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', '0');
INSERT INTO `ims_ewei_shop_member_message_template_type` VALUES ('84', '提现审核完成通知', 'dividend_check', 'OPENTM207574677', '', '业务处理通知', '{{first.DATA}}业务类型：{{keyword1.DATA}}业务状态：{{keyword2.DATA}}业务内容：{{keyword3.DATA}}{{remark.DATA}}', 'dividend', '团队分红通知', '0');

DROP TABLE IF EXISTS `ims_ewei_shop_task_type`;
CREATE TABLE `ims_ewei_shop_task_type` (
  `id` int(11) NOT NULL,
  `type_key` char(20) NOT NULL DEFAULT '',
  `type_name` char(10) NOT NULL DEFAULT '',
  `description` char(30) NOT NULL DEFAULT '',
  `verb` char(11) NOT NULL DEFAULT '',
  `numeric` tinyint(1) NOT NULL DEFAULT '0',
  `unit` char(10) NOT NULL DEFAULT '',
  `goods` tinyint(1) NOT NULL DEFAULT '0',
  `theme` char(10) NOT NULL DEFAULT '',
  `once` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `ims_ewei_shop_task_type` VALUES ('1', 'poster', '任务海报', '把生成的海报并分享给朋友，朋友扫描并关注公众号即可获得奖励。', '转发海报并吸引', '1', '人关注', '0', 'primary', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('2', 'info_phone', '绑定手机', '在个人中心中，绑定手机号，即可完成任务获得奖励。', '绑定手机', '0', '', '0', 'warning', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('3', 'order_first', '首次购物', '在商城中首次下单，即可获得奖励，必须确认收货。', '首次在商城中下单购物', '0', '', '0', 'warning', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('4', 'recharge_full', '单笔充值满额', '在商城中充值余额，单笔充值满额，即可获得奖励。', '单笔充值满', '1', '元', '0', 'success', '1');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('5', 'order_full', '单笔满额', '在商城中下单，单笔满额即可获得奖励，必须确认收货。', '单笔订单满', '1', '元', '0', 'success', '1');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('6', 'order_all', '累计消费', '在商城中购物消费，累计满额即可获得奖励，无需确认收货。', '购物总消费额达到', '1', '元', '0', 'success', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('7', 'pyramid_money', '分销佣金', '只有分销商可接此任务。累计分销佣金满额，即可完成任务。', '分销商获得佣金金额达', '1', '元', '0', 'primary', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('8', 'pyramid_num', '下级人数', '只有分销商可接此任务。累计下级人数达标，即可完成任务。', '分销商推荐下级人数达', '1', '人', '0', 'primary', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('9', 'comment', '商品好评', '任意给一个商品五星好评，即可完成任务获得奖励。', '给商品好评', '0', '', '0', 'warning', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('10', 'post', '社区发帖', '在社区中发表指定篇帖子，即可完成任务获得奖励。', '在论坛中发表', '1', '篇帖子', '0', 'warning', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('11', 'goods', '购买指定商品', '购买指定商品后即可完成任务，必须确认收货。', '购买指定商品', '0', '', '1', 'info', '0');
INSERT INTO `ims_ewei_shop_task_type` VALUES ('12', 'recharge_count', '累计充值满额', '在商城中充值余额，累计充值满额，即可获得奖励。', '累计充值满', '1', '元', '0', 'success', '0');

");
