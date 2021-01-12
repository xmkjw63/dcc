CREATE TABLE IF NOT EXISTS `#__admin` (
  `aid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `user` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `pass` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `email` varchar(30) NOT NULL COMMENT '邮箱',
  `status` int(2) NOT NULL DEFAULT '0' COMMENT '状态, 1正常 0禁止',
  `qq` varchar(35) DEFAULT '0' COMMENT 'QQ',
  `addtime` int(11) NOT NULL COMMENT '注册时间',
  `updtime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='管理员表';
CREATE TABLE IF NOT EXISTS `#__msg` (
  `mid` int(255) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `text` text,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言表';
CREATE TABLE IF NOT EXISTS `#__plog` (
  `lid` int(255) NOT NULL AUTO_INCREMENT,
  `pid` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '应用PID',
  `uid` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `time` int(11) NOT NULL,
  `status` int(2) NOT NULL COMMENT '请求标志，0=请求失败，1=成功',
  PRIMARY KEY (`lid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用日志表';
CREATE TABLE IF NOT EXISTS `#__plugin` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `id` text NOT NULL,
  `name` text NOT NULL,
  `addtime` int(20) NOT NULL,
  `author` text NOT NULL,
  `authorlink` text NOT NULL COMMENT '联系方式，如wx64684684、QQ654654',
  `status` int(20) NOT NULL COMMENT '0=不可使用，1=可使用',
  `needlogin` int(20) NOT NULL COMMENT '0=不需要登录，1=需要登录',
  `popup` int(20) NOT NULL COMMENT '0=不弹窗，1=弹窗',
  `popup_content` text COMMENT '弹窗公告内容',
  `sign` text COMMENT '是否需要验证',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='应用表';
CREATE TABLE IF NOT EXISTS `#__system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COMMENT '网站标题',
  `keywords` text COMMENT '网站关键词',
  `description` text COMMENT '网站描述',
  `admin_name` text COMMENT '管理员名称',
  `admin_qq` text COMMENT '管理员QQ',
  `status` int(2) NOT NULL COMMENT '网站状态',
  `user_status` int(2) NOT NULL COMMENT '注册开关',
  `info_status` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '应用不可用提示',
  `info_needlogin` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '需要登录提示',
  `index_status` text NOT NULL COMMENT '首页是否弹窗',
  `index_content` text COMMENT '首页弹窗内容',
  `msg_status` text NOT NULL COMMENT '留言开关',
  `msg_open` text NOT NULL COMMENT '留言展示',
  `link1` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '友情链接1',
  `link2` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '友情链接2',
  `link3` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '友情链接3',
  `link4` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '友情链接4',
  `copyright` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '版权',
  `webdata` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT '统计代码',
  `sign_vid` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'vid',
  `sign_key` text CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT 'key',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统配置表';
CREATE TABLE IF NOT EXISTS `#__user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '账号',
  `pass` varchar(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '密码',
  `status` int(10) NOT NULL DEFAULT '0' COMMENT '状态, 1正常 0禁止',
  `qq` varchar(35) DEFAULT '0' COMMENT 'QQ',
  `addtime` int(11) NOT NULL COMMENT '注册时间',
  `updtime` int(11) NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';