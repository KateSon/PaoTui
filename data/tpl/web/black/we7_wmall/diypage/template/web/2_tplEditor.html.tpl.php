<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="tpl-parts">
	<nav class="btn btn-link" data-id="page"><i class="fa fa-cog"></i> 页面设置</nav>
	<(each initPart as part)>
		<nav class="btn btn-link" data-id="<(part.id)>"><i class="fa fa-plus"></i> <(part.name)></nav>
	<(/each)>
</script>

<script type="text/html" id="tpl-editor-del">
	<div class="btn-edit-del">
		<div class="btn-edit">编辑</div>
		<div class="btn-del">删除</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-waimai_stores">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下偏移</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右偏移</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fafafa').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商户名称颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<(style.titlecolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#333').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商户评分颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="scorecolor" value="<(style.scorecolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff2d4b').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">配送方背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="deliverytitlebgcolor" value="<(style.deliverytitlebgcolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff2d4b').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">配送方字体颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="deliverytitlecolor" value="<(style.deliverytitlecolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fff').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商户优惠活动</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="showdiscount" value="0" class="diy-bind" data-bind="showdiscount" data-bind-child="params" <(if params.showdiscount=='0' || !params.showdiscount)>checked="checked"<(/if)> > 不显示</label>
			<label class="radio-inline"><input type="radio" name="showdiscount" value="1" class="diy-bind" data-bind="showdiscount" data-bind-child="params" <(if params.showdiscount=='1')>checked="checked"<(/if)>> 显示</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商户热销商品</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="showhotgoods" value="0" class="diy-bind" data-bind="showhotgoods" data-bind-child="params" <(if params.showhotgoods=='0' || !params.showhotgoods)>checked="checked"<(/if)> > 不显示</label>
			<label class="radio-inline"><input type="radio" name="showhotgoods" value="1" class="diy-bind" data-bind="showhotgoods" data-bind-child="params" <(if params.showhotgoods=='1')>checked="checked"<(/if)>> 显示</label>
			<span class="help-block">系统默认会根据门店设置的热销商品调用3个进行显示</span>
		</div>
	</div>
	<div class="line"></div>
	<div class="form-group">
		<div class="col-sm-2 control-label">选择商品</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="storedata" value="0" class="diy-bind" data-bind-child="params" data-bind="storedata" data-bind-init="true" <(if params.storedata=='0')>checked="checked"<(/if)>> 手动选择</label>
			<label class="radio-inline"><input type="radio" name="storedata" value="1" class="diy-bind" data-bind-child="params" data-bind="storedata" data-bind-init="true" <(if params.storedata=='1')>checked="checked"<(/if)> > 调用推荐门店数据</label>
		</div>
	</div>
	<(if params.storedata=='0')>
		<div class="form-items" data-min="1">
			<div class="inner" id="form-items">
				<(each data as child itemid )>
				<div class="item" data-id="<(itemid)>">
					<span class="btn-del" title="删除"></span>
					<div class="item-body">
						<div class="item-image">
							<img src="<(tomedia child.logo)>" id="pimg-<(itemid)>">
							<div class="text js-selectStore" data-input="#pimg-<(index)>" data-element="#cimg-<(index)>" data-callback="callbackStore">选择商户</div>
							<input type="hidden" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="logo"  id="cimg-<(itemid)>" value="<(child.logo)>" />
						</div>
						<div class="item-form">
							<div class="input-group">
								<span class="input-group-addon">名称</span>
								<input class="form-control input-sm" value="<(child.title||'未设置')>" readonly="readonly" />
							</div>
							<div class="input-group">
								<span class="input-group-addon">评分</span>
								<input class="form-control input-sm" value="<(child.score)>" readonly="readonly" />
							</div>
						</div>
					</div>
				</div>
				<(/each)>
			</div>
			<div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
		</div>
	<(/if)>
	<(if params.storedata > 0)>
		<div class="form-group">
			<div class="col-sm-2 control-label">显示数量</div>
			<div class="col-sm-10">
				<div class="form-group margin-t-5">
					<div class="slider col-sm-8" data-value="<(params.storenum)>" data-min="1" data-max="50"></div>
					<div class="col-sm-4 control-labe count"><span><(params.storenum)></span>个</div>
					<input class="diy-bind input" data-bind-child="params" data-bind="storenum" value="<(params.storenum)>" type="hidden" />
				</div>
			</div>
		</div>
	<(/if)>
</script>

<script type="text/html" id="tpl-editor-waimai_goods">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下偏移</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右偏移</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">列表样式</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="liststyle" value="1" class="diy-bind" data-bind-child="style" data-bind="liststyle" data-bind-init="true" <(if style.liststyle == '' || style.liststyle == '1')>checked="checked"<(/if)>> 列表显示</label>
			<label class="radio-inline"><input type="radio" name="liststyle" value="2" class="diy-bind" data-bind-child="style" data-bind="liststyle" data-bind-init="true" <(if style.liststyle == '2')>checked="checked"<(/if)>> 双列显示</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fafafa').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商品名称颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<(style.titlecolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#262626').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商品价格颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="pricecolor" value="<(style.pricecolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ed2822').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">商品原价</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="showoldprice" value="0" class="diy-bind" data-bind-child="params" data-bind="showoldprice" data-bind-init="true" <(if params.showoldprice=='0'||!params.showoldprice)>checked="checked"<(/if)>> 不显示</label>
			<label class="radio-inline"><input type="radio" name="showoldprice" value="1" class="diy-bind" data-bind-child="params" data-bind="showoldprice" data-bind-init="true" <(if params.showoldprice=='1')>checked="checked"<(/if)> > 显示</label>
		</div>
	</div>
	<(if params.showoldprice==1)>
		<div class="form-group">
			<div class="col-sm-2 control-label">原价颜色</div>
			<div class="col-sm-4">
				<div class="input-group">
					<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="oldpricecolor" value="<(style.oldpricecolor)>" type="color" />
					<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#777777').trigger('propertychange')">重置</span>
				</div>
			</div>
		</div>
		<div class="line"></div>
	<(/if)>
	<div class="form-group">
		<div class="col-sm-2 control-label">购买按钮文字</div>
		<div class="col-sm-10">
			<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="buybtntext" value="<(params.buybtntext||'立即抢购')>" style="width: 128px;" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">按钮颜色</div>
		<div class="col-sm-10">
			<div class="input-group" style="width: 130px;">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="buybtncolor" value="<(style.buybtncolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fe5455').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>

	<div class="line"></div>

	<div class="form-group">
		<div class="col-sm-2 control-label">商品图标</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="showicon" value="0" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <(if params.showicon=='0')>checked="checked"<(/if)>> 不显示</label>
			<label class="radio-inline"><input type="radio" name="showicon" value="1" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <(if params.showicon=='1')>checked="checked"<(/if)> > 根据原价与优惠价算折扣显示</label>
<!--
			<label class="radio-inline"><input type="radio" name="showicon" value="2" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <(if params.showicon=='1')>checked="checked"<(/if)> > 系统图标</label>
			<label class="radio-inline"><input type="radio" name="showicon" value="3" class="diy-bind" data-bind-child="params" data-bind="showicon" data-bind-init="true" <(if params.showicon=='2')>checked="checked"<(/if)> > 自定义</label>
-->
			<span class="help-block">当商品的折扣为10时(即:原价和优惠价相同),不会显示图标</span>
		</div>
	</div>
	<(if params.showicon=='3')>
		<div class="form-group">
			<div class="col-sm-2 control-label">自定义图标</div>
			<div class="col-sm-10">
				<div class="input-group">
					<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="goodsiconsrc" placeholder="请输入图片地址或选择图片" value="<(params.goodsiconsrc)>" id="goodsiconsrc" />
					<span data-input="#goodsiconsrc" data-img="#goodsicon" data-toggle="selectImg" class="input-group-addon btn btn-default">选择图片</span>
				</div>
				<div class="input-group " style="margin-top:.5em;">
					<img src="<(tomedia params.goodsiconsrc)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" class="img-responsive img-thumbnail" id="goodsicon" style="width: 60px; height: 60px;">
					<em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片" onclick="$('#goodsiconsrc').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
				</div>
			</div>
		</div>
	<(/if)>
	<(if params.showicon=='2')>
		<div class="form-group">
			<div class="col-sm-2 control-label">系统图标</div>
			<div class="col-sm-10">
				<label class="radio-inline"><input type="radio" name="goodsicon" value="recommand" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <(if style.goodsicon=='recommand')>checked="checked"<(/if)>> 推荐</label>
				<label class="radio-inline"><input type="radio" name="goodsicon" value="hotsale" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <(if style.goodsicon=='hotsale')>checked="checked"<(/if)>> 热销</label>
				<label class="radio-inline"><input type="radio" name="goodsicon" value="isnew" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <(if style.goodsicon=='isnew')>checked="checked"<(/if)>> 新上</label>
				<label class="radio-inline"><input type="radio" name="goodsicon" value="sendfree" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <(if style.goodsicon=='sendfree')>checked="checked"<(/if)>> 包邮</label>
				<label class="radio-inline"><input type="radio" name="goodsicon" value="istime" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <(if style.goodsicon=='istime')>checked="checked"<(/if)>> 限时卖</label>
				<label class="radio-inline"><input type="radio" name="goodsicon" value="bigsale" class="diy-bind" data-bind-child="style" data-bind="goodsicon" <(if style.goodsicon=='bigsale')>checked="checked"<(/if)>> 促销</label>
			</div>
		</div>
	<(/if)>
	<(if params.showicon=='2' || params.showicon=='3')>
		<div class="form-group">
			<div class="col-sm-2 control-label">图标位置</div>
			<div class="col-sm-10">
				<label class="radio-inline"><input type="radio" name="iconposition" value="left top" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <(if params.iconposition=='left top')>checked="checked"<(/if)>> 左上</label>
				<label class="radio-inline"><input type="radio" name="iconposition" value="right top" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <(if params.iconposition=='right top')>checked="checked"<(/if)> > 右上</label>
				<label class="radio-inline"><input type="radio" name="iconposition" value="left bottom" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <(if params.iconposition=='left bottom')>checked="checked"<(/if)> > 左下</label>
				<label class="radio-inline"><input type="radio" name="iconposition" value="right bottom" class="diy-bind" data-bind-child="params" data-bind="iconposition" data-bind-init="true" <(if params.iconposition=='right bottom')>checked="checked"<(/if)> > 右下</label>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">上下偏移</div>
			<div class="col-sm-10">
				<div class="form-group">
					<div class="slider col-sm-8" data-value="<(style.iconpaddingtop)>" data-min="0" data-max="30"></div>
					<div class="col-sm-4 control-labe count"><span><(style.iconpaddingtop)></span>px(像素)</div>
					<input class="diy-bind input" data-bind-child="style" data-bind="iconpaddingtop" value="<(style.iconpaddingtop)>" type="hidden" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">左右偏移</div>
			<div class="col-sm-10">
				<div class="form-group">
					<div class="slider col-sm-8" data-value="<(style.iconpaddingleft)>" data-min="0" data-max="30"></div>
					<div class="col-sm-4 control-labe count"><span><(style.iconpaddingleft)></span>px(像素)</div>
					<input class="diy-bind input" data-bind-child="style" data-bind="iconpaddingleft" value="<(style.iconpaddingleft)>" type="hidden" />
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">图标缩放</div>
			<div class="col-sm-10">
				<div class="form-group">
					<div class="slider col-sm-8" data-value="<(style.iconzoom)>" data-min="1" data-max="100"></div>
					<div class="col-sm-4 control-labe count"><span><(style.iconzoom)></span>%</div>
					<input class="diy-bind input" data-bind-child="style" data-bind="iconzoom" value="<(style.iconzoom)>" type="hidden" />
				</div>
			</div>
		</div>
	<(/if)>
	<div class="line"></div>
	<div class="form-group">
		<div class="col-sm-2 control-label">选择商品</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="goodsdata" value="0" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <(if params.goodsdata=='0')>checked="checked"<(/if)>> 手动选择</label>
			<label class="radio-inline"><input type="radio" name="goodsdata" value="1" class="diy-bind" data-bind-child="params" data-bind="goodsdata" data-bind-init="true" <(if params.goodsdata=='1')>checked="checked"<(/if)> > 调用天天特价商品</label>
		</div>
	</div>
	<(if params.goodsdata=='0')>
		<div class="form-items" data-min="1">
			<div class="inner" id="form-items">
				<(each data as child itemid )>
					<div class="item" data-id="<(itemid)>">
						<span class="btn-del" title="删除"></span>
						<div class="item-body">
							<div class="item-image">
								<img src="<(tomedia child.thumb)>" id="pimg-<(itemid)>">
								<div class="text js-selectGoods" data-input="#pimg-<(index)>" data-element="#cimg-<(index)>" data-callback="callbackGoods">选择商品</div>
								<input type="hidden" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="thumb"  id="cimg-<(itemid)>" value="<(child.thumb)>" />
							</div>
							<div class="item-form">
								<div class="input-group">
									<span class="input-group-addon">名称</span>
									<input class="form-control input-sm" value="<(child.title||'未设置')>" readonly="readonly" />
								</div>
								<div class="input-group">
									<span class="input-group-addon">价格</span>
									<input class="form-control input-sm" value="￥<(child.price)>" readonly="readonly" />
									<span class="input-group-addon">原价</span>
									<input class="form-control input-sm" value="￥<(child.old_price)>" readonly="readonly" />
								</div>
							</div>
						</div>
					</div>
				<(/each)>
			</div>
			<div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
		</div>
	<(/if)>
	<(if params.goodsdata > 0)>
		<div class="form-group">
			<div class="col-sm-2 control-label">显示数量</div>
			<div class="col-sm-10">
				<div class="form-group margin-t-5">
					<div class="slider col-sm-8" data-value="<(params.goodsnum)>" data-min="1" data-max="50"></div>
					<div class="col-sm-4 control-labe count"><span><(params.goodsnum)></span>个</div>
					<input class="diy-bind input" data-bind-child="params" data-bind="goodsnum" value="<(params.goodsnum)>" type="hidden" />
				</div>
			</div>
		</div>
	<(/if)>
</script>

<script type="text/html" id="tpl-editor-page">
	<div class="form-group">
		<div class="col-sm-2 control-label">页面名称</div>
		<div class="col-sm-10">
			<input class="form-control input-sm diy-bind" data-bind="name" data-placeholder="请输入名称" placeholder="请输入名称" value="<(page.name)>" />
			<div class="help-block">注意：页面名称是便于后台查找，页面标题是手机端标题。</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">页面标题</div>
		<div class="col-sm-10">
			<input class="form-control input-sm diy-bind" data-bind="title" data-placeholder="请输入标题" placeholder="请输入标题" value="<(page.title)>" />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">页面介绍</div>
		<div class="col-sm-10">
			<textarea class="form-control richtext diy-bind" cols="70" rows="3" placeholder="请输入页面介绍" data-bind="desc" data-placeholder=""><(page.desc)></textarea>
			<span class="help-block">分享时调用</span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">封面图</div>
		<div class="col-sm-10">
			<div class="input-group">
				<input class="form-control input-sm diy-bind" data-bind="thumb" data-placeholder="" placeholder="" value="<(page.thumb)>" id="thumbsrc" />
				<span data-input="#thumbsrc" data-element="#thumbimg" class="input-group-addon btn btn-default js-selectImg">选择图片</span>
			</div>
			<div class="input-group margin-t-5">
				<img src="<(tomedia page.thumb)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" class="img-responsive img-thumbnail" width="150" id="thumbimg">
				<em class="close" title="删除这张图片" onclick="$('#thumbsrc').val('').trigger('change');$(this).prev().attr('src', '')">×</em>
			</div>
			<span class="help-block">分享时调用</span>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind="background" value="<(page.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#efeff4').trigger('propertychange')">重置</span>
			</div>
		</div>
	</div>
	<div class="line"></div>
	<div class="form-group">
		<div class="col-sm-2 control-label">底部菜单</div>
		<div class="col-sm-10">
			<select class="form-control input-sm diy-bind" data-bind="diymenu">
				<option value="-1"<(if page.diymenu=='-1')>selected="selected"<(/if)>>不显示</option>
				<option value="0" <(if page.diymenu=='0')>selected="selected"<(/if)>>系统默认</option>
				<(each diymenu as menu)>
					<option value="<(menu.id)>" <(if page.diymenu==menu.id)>selected="selected"<(/if)>><(menu.name)></option>
				<(/each)>
			</select>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">关注条</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="followbar" value="0" class="diy-bind" data-bind="followbar" <(if page.followbar=='0' || !page.followbar)>checked="checked"<(/if)> > 不显示</label>
			<label class="radio-inline"><input type="radio" name="followbar" value="1" class="diy-bind" data-bind="followbar" <(if page.followbar=='1')>checked="checked"<(/if)>> 显示</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">下单提醒</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="danmu" value="0" class="diy-bind" data-bind="danmu" <(if page.danmu=='0' || !page.danmu)>checked="checked"<(/if)> > 不显示</label>
			<label class="radio-inline"><input type="radio" name="danmu" value="1" class="diy-bind" data-bind="danmu" <(if page.danmu=='1')>checked="checked"<(/if)>> 显示</label>
			<div class="help-block">提示：设置请至 <a href="<?php  echo iurl('diypage/danmu')?>" target="_blank">下单提醒</a> 中设置 未设置则不显示</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-banner">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-items indent" data-min="1">
		<div class="inner" id="form-items">
			<(each data as child itemid )>
				<div class="item" data-id="<(itemid)>">
					<span class="btn-del" title="删除"></span>
					<div class="item-body">
						<div class="item-image">
							<img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
						</div>
						<div class="item-form">
							<div class="input-group" style="margin-bottom:0px; ">
								<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" placeholder="请选择图片或输入图片地址" value="<(child.imgurl)>" />
								<span class="input-group-addon btn btn-default js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</span>
							</div>
							<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
								<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
								<span class="input-group-addon btn btn-default js-selectLink" data-input="#curl-<(itemid)>">选择链接</span>
							</div>
						</div>
					</div>
				</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-img_card">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">图片</div>
		<div class="col-sm-10">
			<div class="input-group">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="imgurl" value="<(params.imgurl)>" id="tomedia" />
				<span data-input="#tomedia" data-element="#iconimg" class="input-group-addon btn btn-default js-selectImg">选择图片</span>
			</div>
			<div class="input-group " style="margin-top:.5em;">
				<img src="<(tomedia params.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" class="img-responsive img-thumbnail" width="150" id="iconimg">
				<span class="close" style="position:absolute; top: -10px; right: -14px;" title="移除图片" onclick="$('#tomedia').val('').trigger('change');$(this).prev().attr('src', '')">×</span>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-line">
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">线条颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="bordercolor" value="<(style.bordercolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">线条样式</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="linestyle" value="solid" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='solid')>checked="checked"<(/if)> > 实线</label>
			<label class="radio-inline"><input type="radio" name="linestyle" value="dashed" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='dashed')>checked="checked"<(/if)>> 虚线(长方形)</label>
			<label class="radio-inline"><input type="radio" name="linestyle" value="dotted" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='dotted')>checked="checked"<(/if)>> 虚线(正方形)</label>
			<label class="radio-inline"><input type="radio" name="linestyle" value="double" class="diy-bind" data-bind-child="style" data-bind="linestyle" <(if style.linestyle=='double')>checked="checked"<(/if)>> 双实线</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">线条高度</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.height)>" data-min="1" data-max="20"></div>
				<div class="col-sm-4 control-labe count"><span><(style.height)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="height" value="<(style.height)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.padding)>" data-min="1" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.height)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="padding" value="<(style.padding)>" type="hidden" />
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-blank">
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">元素高度</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.height)>" data-min="1" data-max="200"></div>
				<div class="col-sm-4 control-labe count"><span><(style.height)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="height" value="<(style.height)>" type="hidden" />
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-picturew">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">布局方式</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="row" value="1" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <(if params.row=='1')>checked="checked"<(/if)>> 橱窗样式</label>
			<label class="radio-inline"><input type="radio" name="row" value="2" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <(if params.row=='2')>checked="checked"<(/if)>> 堆积两列</label>
			<label class="radio-inline"><input type="radio" name="row" value="3" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <(if params.row=='3')>checked="checked"<(/if)> > 堆积三列</label>
			<label class="radio-inline"><input type="radio" name="row" value="4" class="diy-bind" data-bind-child="params" data-bind="row" data-bind-init="true" <(if params.row=='4')>checked="checked"<(/if)> > 堆积四列</label>
			<(if params.row == 1)>
				<div class="help-block">橱窗样式布局单组最多显示四个，超出隐藏</div>
			<(/if)>
			<(if params.row > 1)>
				<div class="help-block">图片大小不限制，但请确保所有图片的尺寸/比例相同。</div>
			<(/if)>
		</div>
	</div>
	<(if params.row>1)>
		<div class="form-group">
			<div class="col-sm-2 control-label">显示类型</div>
			<div class="col-sm-10">
				<label class="radio-inline"><input type="radio" name="showtype" value="0" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <(if params.showtype=='0'||!params.showtype)>checked="checked"<(/if)>> 普通模式</label>
				<label class="radio-inline"><input type="radio" name="showtype" value="1" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <(if params.showtype=='1')>checked="checked"<(/if)> > 多页滑动模式</label>
			</div>
		</div>
	<(/if)>
	<(if params.row > 1 && params.showtype == 1)>
		<div class="form-group">
			<div class="col-sm-2 control-label">每页数量</div>
			<div class="col-sm-10">
				<div class="form-group margin-t-5">
					<div class="slider col-sm-8" data-value="<(style.pagenum || 2)>" data-min="2" data-max="12"></div>
					<div class="col-sm-4 control-labe count"><span><(style.pagenum || 2)></span>个</div>
					<input class="diy-bind input" data-bind-child="style" data-bind="pagenum" value="<(style.pagenum || 2)>" type="hidden" />
				</div>
				<div class="help-block">超出设定数量自动分页</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">显示分页</div>
			<div class="col-sm-10">
				<label class="radio-inline"><input type="radio" name="showdot" value="0" class="diy-bind" data-bind-child="style" data-bind="showdot" data-bind-init="true"<(if style.showdot=='0'||!style.showdot)>checked="checked"<(/if)>> 隐藏</label>
				<label class="radio-inline"><input type="radio" name="showdot" value="1" class="diy-bind" data-bind-child="style" data-bind="showdot" data-bind-init="true"<(if style.showdot=='1')>checked="checked"<(/if)>> 显示</label>
			</div>
		</div>
		<(if style.showdot == 1)>
			<div class="form-group">
				<div class="col-sm-2 control-label">分页按钮颜色</div>
				<div class="col-sm-4">
					<div class="input-group">
						<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="dotbackground" value="<(style.dotbackground)>" type="color" />
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff2d4b').trigger('propertychange')">清除</span>
					</div>
				</div>
			</div>
		<(/if)>
	<(/if)>
	<div class="form-items indent" data-min="2" data-max="20">
		<div class="inner" id="form-items">
			<(each data as child itemid )>
				<div class="item" data-id="<(itemid)>">
					<span class="btn-del" title="删除"></span>
					<div class="item-image">
						<img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
					</div>
					<div class="item-form">
						<div class="input-group" style="margin-bottom:0px; ">
							<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" placeholder="请选择图片或输入图片地址" value="<(child.imgurl)>" />
							<span class="input-group-addon btn btn-default js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</span>
						</div>
						<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
							<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
							<span class="input-group-addon btn btn-default js-selectLink" data-input="#curl-<(itemid)>">选择链接</span>
						</div>
					</div>
				</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-richtext">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-richtext">
		<div id="rich"></div>
		<textarea id="richtext" class="diy-bind" data-bind-child="params" data-bind="content" style="display: none"></textarea>
	</div>
</script>

<script type="text/html" id="tpl-editor-picture">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">背景颜色</div>
		<div class="col-sm-4">
			<div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">分页按钮位置</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="dotalign" value="left" class="diy-bind" data-bind-child="style" data-bind="dotalign" <(if style.dotalign=='left')>checked="checked"<(/if)> > 居左</label>
			<label class="radio-inline"><input type="radio" name="dotalign" value="center" class="diy-bind" data-bind-child="style" data-bind="dotalign" <(if style.dotalign=='center')>checked="checked"<(/if)>> 居中</label>
			<label class="radio-inline"><input type="radio" name="dotalign" value="right" class="diy-bind" data-bind-child="style" data-bind="dotalign" <(if style.dotalign=='right')>checked="checked"<(/if)>> 居右</label>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">分页按钮颜色</div>
		<div class="col-sm-4">
			<div class="input-group input-group-sm">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="dotbackground" value="<(style.dotbackground)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">分页按钮左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.leftright)>" data-min="5" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.leftright)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="leftright" value="<(style.leftright)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">分页按钮底部边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.bottom)>" data-min="5" data-max="30"></div>
				<div class="col-sm-4 control-labe count"><span><(style.bottom)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="bottom" value="<(style.bottom)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-items" data-min="1">
		<div class="inner" id="form-items">
			<(each data as child itemid )>
			<div class="item" data-id="<(itemid)>">
				<span class="btn-del" title="删除"></span>
				<div class="item-image">
					<img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
				</div>
				<div class="item-form">
					<div class="input-group" style="margin-bottom:0px; ">
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" placeholder="请选择图片或输入图片地址" value="<(child.imgurl)>" />
						<span class="input-group-addon btn btn-default js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</span>
					</div>
					<div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
						<input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
						<span class="input-group-addon btn btn-default js-selectLink" data-input="#curl-<(itemid)>">选择链接</span>
					</div>
				</div>
			</div>
			<(/each)>
		</div>
		<div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
	</div>
</script>

<script type="text/html" id="tpl-editor-navs">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">按钮形状</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="navstyle" value="" class="diy-bind" data-bind-child="style" data-bind="navstyle" <(if style.navstyle=='')>checked="checked"<(/if)>> 正方形</label>
            <label class="radio-inline"><input type="radio" name="navstyle" value="radius" class="diy-bind" data-bind-child="style" data-bind="navstyle" <(if style.navstyle=='radius')>checked="checked"<(/if)>> 圆角</label>
            <label class="radio-inline"><input type="radio" name="navstyle" value="circle" class="diy-bind" data-bind-child="style" data-bind="navstyle" <(if style.navstyle=='circle')>checked="checked"<(/if)>> 圆形</label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">每行数量</div>
        <div class="col-sm-10">
        	<label class="radio-inline"><input type="radio" name="rownum" value="3" class="diy-bind" data-bind-child="params" data-bind="rownum" <(if params.rownum=='3')>checked="checked"<(/if)>> 3个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="4" class="diy-bind" data-bind-child="params" data-bind="rownum" <(if params.rownum=='4')>checked="checked"<(/if)>> 4个</label>
            <label class="radio-inline"><input type="radio" name="rownum" value="5" class="diy-bind" data-bind-child="params" data-bind="rownum" <(if params.rownum=='5')>checked="checked"<(/if)>> 5个</label>
        </div>
    </div>
	
	<div class="form-group">
		<div class="col-sm-2 control-label">显示类型</div>
		<div class="col-sm-10">
			<label class="radio-inline"><input type="radio" name="showtype" value="0" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <(if params.showtype=='0'||!params.showtype)>checked="checked"<(/if)>> 普通模式</label>
			<label class="radio-inline"><input type="radio" name="showtype" value="1" class="diy-bind" data-bind-child="params" data-bind="showtype" data-bind-init="true" <(if params.showtype=='1')>checked="checked"<(/if)> > 多页滑动模式</label>
		</div>
	</div>
	
	<(if params.showtype == 1)>
		<div class="form-group">
			<div class="col-sm-2 control-label">每页数量</div>
			<div class="col-sm-10">
				<div class="form-group margin-t-5">
					<div class="slider col-sm-8" data-value="<(params.pagenum || 8)>" data-min="2" data-max="12"></div>
					<div class="col-sm-4 control-labe count"><span><(params.pagenum || 8)></span>个</div>
					<input class="diy-bind input" data-bind-child="params" data-bind="pagenum" value="<(params.pagenum || 8)>" type="hidden" />
				</div>
				<div class="help-block">超出设定数量自动分页</div>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-2 control-label">显示分页</div>
			<div class="col-sm-10">
				<label class="radio-inline"><input type="radio" name="showdot" value="0" class="diy-bind" data-bind-child="params" data-bind="showdot" data-bind-init="true"<(if params.showdot=='0'||!params.showdot)>checked="checked"<(/if)>> 隐藏</label>
				<label class="radio-inline"><input type="radio" name="showdot" value="1" class="diy-bind" data-bind-child="params" data-bind="showdot" data-bind-init="true"<(if params.showdot=='1')>checked="checked"<(/if)>> 显示</label>
			</div>
		</div>
		<(if params.showdot == 1)>
			<div class="form-group">
				<div class="col-sm-2 control-label">分页按钮颜色</div>
				<div class="col-sm-4">
					<div class="input-group">
						<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="dotbackground" value="<(style.dotbackground)>" type="color" />
						<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ff2d4b').trigger('propertychange')">清除</span>
					</div>
				</div>
			</div>
		<(/if)>
	<(/if)>

    <div class="form-items" data-min="1">
        <div class="inner" id="form-items">
            <(each data as child itemid )>
            <div class="item" data-id="<(itemid)>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image square">
                    <div class="text js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</div>
                    <img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>" />
                    <input type="hidden" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" value="<(child.imgurl)>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">文字</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="text" placeholder="请选择图片或输入图片地址" value="<(child.text)>" style="width: 60%" />
                        <input class="form-control input-sm diy-bind color " data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="color" value="<(child.color)>" type="color" style="width: 40%" />
                        <span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">重置颜色</span>
                    </div>
                    <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址" value="<(child.linkurl)>" />
                        <span class="input-group-addon btn btn-default js-selectLink" data-input="#curl-<(itemid)>">选择链接</span>
                    </div>
                </div>
            </div>
            <(/each)>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>
</script>

<script type="text/html" id="tpl-editor-notice">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>
    <div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">小图标颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="iconcolor" value="<(style.iconcolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#fd5454').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">公告颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="textcolor" value="<(style.textcolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#666666').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>
	<div class="form-group">
		<div class="col-sm-2 control-label">公告图标</div>
		<div class="col-sm-10">
			<div class="input-group">
				<input class="form-control input-sm diy-bind" data-bind-child="params" data-bind="imgurl" value="<(params.imgurl)>" id="tomedia" />
				<span data-input="#tomedia" data-element="#iconimg" class="input-group-addon btn btn-default js-selectImg">选择图片</span>
			</div>
			<div class="input-group " style="margin-top:.5em;">
				<img src="<(tomedia params.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" class="img-responsive img-thumbnail" width="150" id="iconimg">
				<span class="close" style="position:absolute; top: -10px; right: -14px;" title="移除图片" onclick="$('#tomedia').val('').trigger('change');$(this).prev().attr('src', '')">×</span>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-2 control-label">滚动速度</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(params.speed)>" data-min="1" data-max="10"></div>
				<div class="col-sm-4 control-labe count"><span><(params.speed)></span>秒</div>
				<input class="diy-bind input" data-bind-child="params" data-bind="speed" value="<(params.speed)>" type="hidden" />
			</div>
		</div>
	</div>

    <div class="form-group">
        <div class="col-sm-2 control-label">公告内容</div>
        <div class="col-sm-10">
            <label class="radio-inline"><input type="radio" name="noticedata" value="0" class="diy-bind" data-bind-child="params" data-bind="noticedata" data-bind-init="true" <(if params.noticedata=='0')>checked="checked"<(/if)> > 读取商城公告</label>
            <label class="radio-inline"><input type="radio" name="noticedata" value="1" class="diy-bind" data-bind-child="params" data-bind="noticedata" data-bind-init="true" <(if params.noticedata=='1')>checked="checked"<(/if)>> 手动填写</label>
        </div>
    </div>

    <(if params.noticedata=='1')>
        <div class="form-items indent" data-min="1">
            <div class="inner" id="form-items">
                <(each data as child itemid )>
                <div class="item" data-id="<(itemid)>">
                    <span class="btn-del" title="删除"></span>
                    <div class="item-image drag-btn square" style="line-height: 70px;">拖动排序</div>
                    <div class="item-form">
                        <div class="input-group" style="margin-bottom:0px; ">
                            <span class="input-group-addon">标题</span>
                            <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="title" placeholder="请输入公告标题" value="<(child.title)>" />
                        </div>
                        <div class="input-group" style="margin-top:10px; margin-bottom:0px; ">
                            <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址(http://开头)" value="<(child.linkurl)>" />
                            <span class="input-group-addon btn btn-default js-selectLink" data-input="#curl-<(itemid)>">选择链接</span>
                        </div>
                    </div>
                </div>
                <(/each)>
            </div>
            <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
        </div>
    <(/if)>

    <(if params.noticedata=='0')>
        <div class="form-group">
            <div class="col-sm-2 control-label">读取数量</div>
            <div class="col-sm-10">
                <label class="radio-inline"><input type="radio" name="noticenum" value="5" class="diy-bind" data-bind-child="params" data-bind="noticenum" <(if params.noticenum=='5')>checked="checked"<(/if)> > 5条</label>
                <label class="radio-inline"><input type="radio" name="noticenum" value="10" class="diy-bind" data-bind-child="params" data-bind="noticenum" <(if params.noticenum=='10')>checked="checked"<(/if)>> 10条</label>
                <label class="radio-inline"><input type="radio" name="noticenum" value="20" class="diy-bind" data-bind-child="params" data-bind="noticenum" <(if params.noticenum=='20')>checked="checked"<(/if)>> 20条</label>
            </div>
        </div>
    <(/if)>
</script>

<script type="text/html" id="tpl-editor-graphic">
	<div class="form-group">
		<div class="col-sm-2 control-label">上下边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingtop)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingtop)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingtop" value="<(style.paddingtop)>" type="hidden" />
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-2 control-label">左右边距</div>
		<div class="col-sm-10">
			<div class="form-group margin-t-5">
				<div class="slider col-sm-8" data-value="<(style.paddingleft)>" data-min="0" data-max="50"></div>
				<div class="col-sm-4 control-labe count"><span><(style.paddingleft)></span>px(像素)</div>
				<input class="diy-bind input" data-bind-child="style" data-bind="paddingleft" value="<(style.paddingleft)>" type="hidden" />
			</div>
		</div>
	</div>

	<div class="form-group">
        <div class="col-sm-2 control-label">背景颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="background" value="<(style.background)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#efeff4').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-2 control-label">导航栏卡片背景色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="cardbackground" value="<(style.cardbackground)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#ffffff').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">主标题颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="titlecolor" value="<(style.titlecolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#333').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-2 control-label">副标题颜色</div>
        <div class="col-sm-4">
	        <div class="input-group">
				<input class="form-control input-sm diy-bind color" data-bind-child="style" data-bind="subheadcolor" value="<(style.subheadcolor)>" type="color" />
				<span class="input-group-addon btn btn-default" onclick="$(this).prev().val('#606060').trigger('propertychange')">清除</span>
			</div>
        </div>
    </div>

    <div class="form-items indent" data-min="1">
        <div class="inner" id="form-items">
            <(each data as child itemid )>
            <div class="item" data-id="<(itemid)>">
                <span class="btn-del" title="删除"></span>
                <div class="item-image square" style="height: 100px;">
                    <div class="text js-selectImg" data-input="#cimg-<(itemid)>" data-img="#pimg-<(itemid)>" data-element="#pimg-<(itemid)>">选择图片</div>
                    <img src="<(tomedia child.imgurl)>" onerror="this.src='../addons/we7_wmall/static/img/nopic.jpg';" id="pimg-<(itemid)>"  style= "height: 77px;"/>
                    <input type="hidden" class="diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="imgurl"  id="cimg-<(itemid)>" value="<(child.imgurl)>" />
                </div>
                <div class="item-form">
                    <div class="input-group" style="margin-bottom:8px; ">
                        <span class="input-group-addon">主标题</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="title" placeholder="请输入主标题" value="<(child.title)>" />
                    </div>
                    <div class="input-group" style="margin-bottom:0px; ">
                        <span class="input-group-addon">副标题</span>
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="subhead" placeholder="请输入副标题" value="<(child.subhead)>" />
                    </div>
                    <div class="input-group" style="margin-top:8px; margin-bottom:0px; ">
                        <input type="text" class="form-control input-sm diy-bind" data-bind-parent="data" data-bind-child="<(itemid)>" data-bind="linkurl" id="curl-<(itemid)>" placeholder="请选择链接或输入链接地址(http://开头)" value="<(child.linkurl)>" />
                        <span class="input-group-addon btn btn-default js-selectLink" data-input="#curl-<(itemid)>">选择链接</span>
                    </div>
                </div>
            </div>
            <(/each)>
        </div>
        <div class="btn btn-w-m btn-block btn-default btn-outline" id="addChild"><i class="fa fa-plus"></i> 添加一个</div>
    </div>

</script>