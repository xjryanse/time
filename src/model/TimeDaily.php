<?php
namespace xjryanse\time\model;

/**
CREATE TABLE `w_time_daily` (
  `id` char(19) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `company_id` int(11) DEFAULT NULL COMMENT '公司',
  `time_key` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '时间key:',
  `date` date DEFAULT CURRENT_TIMESTAMP COMMENT '日期',
  `describe` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '描述说明',
  `sort` int(11) DEFAULT '1000' COMMENT '排序',
  `status` tinyint(1) DEFAULT '1' COMMENT '状态(0禁用,1启用)',
  `has_used` tinyint(1) DEFAULT '0' COMMENT '有使用(0否,1是)',
  `is_lock` tinyint(1) DEFAULT '0' COMMENT '锁定（0：未锁，1：已锁）',
  `is_delete` tinyint(1) DEFAULT '0' COMMENT '锁定（0：未删，1：已删）',
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '备注',
  `creater` char(19) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '创建者，user表',
  `updater` char(19) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '' COMMENT '更新者，user表',
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `creater` (`creater`),
  KEY `updater` (`updater`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='每日的信息';
 */
class TimeDaily extends Base
{
    

}