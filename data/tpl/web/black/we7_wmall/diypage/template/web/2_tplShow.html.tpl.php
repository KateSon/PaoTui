<?php defined('IN_IA') or exit('Access Denied');?><script type="text/html" id="tpl-show-waimai_stores">
	<style type="text/css">
		.diy-waimai-store-box .waimai-store-item .content-right .item-star-box .stars-bg{color: <(style.scorecolor)>}
	</style>
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-waimai-store-box" style="background-color: <(style.background)>; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px;">
			<div class="waimai-store-item-list">
				<(each data as item)>
				<div class="waimai-store-item border-1px-b">
					<div class="mian-content-box">
						<div class="content-left border-1px">
							<a href="">
								<img src="<(tomedia item.logo)>" alt="">
							</a>
						</div>
						<div class="content-right">
							<a href="">
								<div class="item-name-wrap">
									<div class="item-name" style="color: <(style.titlecolor)>;"><(item.title)></div>
								</div>
								<div class="item-score-sale">
									<div class="item-star-box">
										<div class="stars">
											<i class='icon icon-favor_light'></i><i class='icon icon-favor_light'></i><i class='icon icon-favor_light'></i><i class='icon icon-favor_light'></i><i class='icon icon-favor_light'></i>
										</div>
										<div class="stars-bg" style="width: <(item.score_cn)>%; color: <(style.scorecolor)>">
											<i class='icon icon-favor_fill_light'></i><i class='icon icon-favor_fill_light'></i><i class='icon icon-favor_fill_light'></i><i class='icon icon-favor_fill_light'></i><i class='icon icon-favor_fill_light'></i>
										</div>
									</div>
									<div class="item-sale">已售<(item.sailed)>单</div>
									<div class="time-distance">
										<div class="avg_delivery_time"><(item.delivery_time)>分钟</div>
										<!--
											<span class='line'>|</span>
											<div class="item-distance">914m</div>
										-->
									</div>

								</div>
								<div class="item-min-delivery">
									<span>起送价￥<(item.send_price)></span>
									<span class='line'>|</span>
									<span>配送费￥<(item.delivery_price)></span>
									<div style="background-color: <(style.deliverytitlebgcolor)>; color: <(style.deliverytitlecolor)>;">平台专送</div>
								</div>
							</a>
							<(if params.showdiscount == 1 && item.activity && item.activity.num)>
								<div class="discount-box">
									<i class="icon icon-unfold"></i>
									<(each item.activity.items as activity)>
										<div class="single-line">
											<img class="discount-icon" src="<?php echo WE7_WMALL_TPL_URL;?>static/img/icon-<(activity.type)>.png" alt="">
											<span><(activity.title)></span>
										</div>
									<(/each)>
								</div>
							<(/if)>
							<(if params.showhotgoods == 1 && count(item.hot_goods) > 0)>
								<div class="hot-box">
									<(each item.hot_goods as goods)>
										<div class="hot-box-item">
											<div class="hot-t border-1px">
												<img src="<(tomedia goods.thumb)>" alt="">
												<div>省36%</div>
											</div>
											<div class="hot-b">
												<div class="shop-name"><(goods.title)></div>
												<div class="shop-price">
													<span class="price">¥<(goods.price)></span>
													<span class="old-price">¥<(goods.old_price)></span>
												</div>
											</div>
										</div>
									<(/each)>
								</div>
							<(/if)>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<(/each)>
			</div>
		</div>
	</div>
</script>
<script type="text/html" id="tpl-show-waimai_goods">
	<div class="drag" data-itemid="<(itemid)>">
		<(if style.liststyle == 1)>
			<div class="diy-waimai-food-list-onerow-box" style="background-color: <(style.background)>; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px;">
				<div class="item-list">
					<(each data as item)>
						<div class="goods-item border-1px-t">
							<div class="row item-wrapper">
								<div class="col-40 goods-img">
									<img src="<(tomedia item.thumb)>">
									<(if params.showicon == 1 && item.discount < 10)>
										<span class='discount'><(item.discount)>折</span>
									<(/if)>
								</div>
								<div class="col-60">
									<div class="goods-name" style="color: <(style.titlecolor)>"><(item.title)></div>
									<div class="sale-num">已售:<(item.sailed)> 好评率:<(item.comment_good_percent)></div>
									<div class="store-num">
										<i class="icon icon-shop"></i>
										<span><(item.store_title)></span>
									</div>
									<div class="price-buybtn">
										<div class="price-wrap">
											<span class="price" style="color: <(style.pricecolor)>">¥<(item.price)></span>
											<(if params.showoldprice == 1)>
												<span class="old-price" style="color: <(style.oldpricecolor)>">¥<(item.old_price)></span>
											<(/if)>
										</div>
										<a href="javascript:;" class="buy-btn" style="background-color: <(style.buybtncolor)>"><(params.buybtntext)></a>
									</div>
								</div>
							</div>
						</div>
					<(/each)>
				</div>
			</div>
		<(else if style.liststyle == 2)>
			<div class="diy-waimai-goods-list-box" style="background-color: <(style.background)>; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px;">
				<div class="box-list">
					<(each data as item)>
						<div class="box-item">
							<div class="main-content-box">
								<(if params.showicon == 1)>
									<span class='discount'><(item.discount)>折</span>
								<(/if)>
								<div class="goods-image">
									<img src="<(tomedia item.thumb)>">
								</div>
								<div class="goods-name" style="color: <(style.titlecolor)>"><(item.title)></div>
								<div class="discount-soldnum">
									<span class='sold-num'>已售<(item.sailed)>份</span>
									<span class='praise'>好评率<(item.comment_good_percent)>%</span>
								</div>
								<div class="store-name">
									<i class="icon icon-shop"></i>
									<(item.store_title)>
								</div>
								<div class="price-buybtn">
									<div class="price" style="color: <(style.pricecolor)>">
										￥<(item.price)>
										<(if params.showoldprice == 1)>
											<div class="old-price" style="color: <(style.oldpricecolor)>">¥<(item.old_price)></div>
										<(/if)>
									</div>
									<a href="javascript:;" class="buy-btn" style="background-color: <(style.buybtncolor)>"><(params.buybtntext)></a>
								</div>
							</div>
						</div>
					<(/each)>
				</div>
				<div class="clear"></div>
			</div>
		<(/if)>
	</div>
</script>

<script type="text/html" id="tpl-show-banner">
	<div class="drag" data-itemid="<(itemid)>">
		<(each data as item)>
			<div class="diy-banner" style="padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; background: <(style.background)>;">
				<img src="<(tomedia item.imgurl)>" alt="">
			</div>
		<(/each)>
	</div>
</script>

<script type="text/html" id="tpl-show-navs">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-navs" style="background: <(style.background)>; padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px;">
			<div class="diy-navs-container col-<(params.rownum)> <(style.navstyle)>">
				<(each data as item)>
					<div class="diy-nav-col">
						<a href="javascript:;">
							<div class="nav-icon">
								<img src="<(tomedia item.imgurl)>" alt="">
							</div>
							<div class="nav-text" style="color: <(item.color)>"><(item.text)></div>
						</a>
					</div>
				<(/each)>
				<div class="clear"></div>
				<(if params.showdot == 1 && params.showtype == 1)>
					<div class="diy-nav-page">
						<span style="background: <(style.dotbackground)>"></span>
						<span style="background: <(style.dotbackground)>"></span>
					</div>
				<(/if)>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-img_card">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-img-card" style="padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; background: <(style.background)>;">
			<img src="<(tomedia params.imgurl)>" alt="">
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-richtext">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-richtext" style="background: <(style.background)>; padding: <(style.paddingtop)>px <(style.paddingleft)>px;">
			<div class="text-container">
				<(if params.content)>
					<(=decode(params.content))>
				<(else)>
					<p><span style="font-size: 20px;">哈喽大家好！这里是『富文本』区域</span></p>
					<p>你可以对文字进行<strong>加粗</strong>、<em>斜体</em>、<span style="text-decoration: underline;">下划线</span>、<span style="text-decoration: line-through;">删除线</span>、文字<span style="color: rgb(0, 176, 240);">颜色</span>、<span style="background-color: rgb(255, 192, 0); color: rgb(255, 255, 255);">背景色</span>、以及字号<span style="font-size: 20px;">大</span><span style="font-size: 14px;">小</span>等简单排版操作。
					</p>
					<p>也可在这里插入图片</p>
					<p style="text-align: left;"><span style="text-align: left;">还可给文字加上<a href="http://www.baidu.com">超级链接</a>，方便用户点击。</span></p>
				<(/if)>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-picture">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-picture" style="padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px; background: <(style.background)>;">
			<(each data as item)>
				<img src="<(tomedia item.imgurl)>" />
			<(/each)>
			<div class="dots <(style.dotalign||'left')>" style="padding: 0 <(style.leftright||'10')>px; bottom: <(style.bottom||'10')>px;">
				<(each data as item)>
					<span style="background: <(style.dotbackground||'#000000')>;"></span>
				<(/each)>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-line">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-line" style="background: <(style.background)>; padding: <(style.padding)>px 0;">
			<div class="line" style="border-top: <(style.height || '2')>px <(style.linestyle || 'solid')> <(style.bordercolor || '#000000')>"></div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-blank">
	<div class="drag" data-itemid="<(itemid)>" style="height: <(style.height)>px; background: <(style.background)>"></div>
</script>

<script type="text/html" id="tpl-show-picturew">
	<div class="drag" data-itemid="<(itemid)>">
		<(if params.row == '1')>
			<div class="diy-cube" style="background: <(style.background)>; <(if count(data)==1)>padding: <(style.paddingtop)>px <(style.paddingleft)>px;<(/if)>">
				<(if count(data) == 1)>
					<img src="<(tomedia(toArray(data)[0].imgurl))>" />
				<(/if)>
				<(if count(data) > 1)>
					<div class="diy-cube-left" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px; padding-right: 0;">
						<img src="<(tomedia(toArray(data)[0].imgurl))>" />
					</div>
					<div class="diy-cube-right" <(if count(data)==2)> style="padding: <(style.paddingtop)>px <(style.paddingleft)>px;"<(/if)>>
						<(if count(data) == 2)>
							<img src="<(tomedia(toArray(data)[1].imgurl))>" />
						<(/if)>
						<(if count(data) > 2)>
							<div class="diy-cube-right1" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px; padding-bottom: 0;">
								<img src="<(tomedia(toArray(data)[1].imgurl))>" />
							</div>
							<div class="diy-cube-right2" <(if count(data)==3)> style="padding: <(style.paddingtop)>px <(style.paddingleft)>px;"<(/if)>>
								<(if count(data) == 3)>
									<img src="<(tomedia(toArray(data)[2].imgurl))>" />
								<(/if)>
								<(if count(data) > 3)>
									<div class="left" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px; padding-right: 0;">
										<img src="<(tomedia(toArray(data)[2].imgurl))>" />
									</div>
								<(/if)>
								<(if count(data) >= 4)>
									<div class="right" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px;">
										<img src="<(tomedia(toArray(data)[3].imgurl))>" />
									</div>
								<(/if)>
							</div>
						<(/if)>
					</div>
				<(/if)>
			</div>
		<(/if)>
		<(if params.row > 1)>
			<div class="diy-picturew row-<(params.row)>" style="padding: <(style.paddingtop)>px; <(style.paddingleft)>px; background: <(style.background)>;">
				<(each data as item)>
					<div class="item" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px;">
						<img src="<(tomedia item.imgurl)>">
					</div>
				<(/each)>
				<(if style.showdot > 0 && params.showtype == 1)>
					<div class="clear"></div>
					<div class="diy-picturew-pagination">
						<a class="active"></a>
						<a></a>
					</div>
				<(/if)>
			</div>
		<(/if)>
	</div>
</script>

<script type="text/html" id="tpl-show-pictures">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-picturew row-<(params.rownum)>" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px; background: <(style.background)>;">
			<(each data as item)>
			<div class="item" style="padding: <(style.paddingtop)>px <(style.paddingleft)>px;">
				<div class="image">
					<img src="<(tomedia item.imgurl)>">
					<(if item.title!='')>
					<div class="title" style="color: <(style.titlecolor)>; text-align: <(style.titlealign)>;"><(item.title)></div>
					<(/if)>
				</div>
				<div class="text" style="color: <(style.textcolor)>; text-align: <(style.textalign)>;""><(item.text)></div>
		</div>
		<(/each)>
		<(if style.showdot>0&&params.showtype==1)>
			<div class="diy-picturew-pagination">
				<a class="active"></a>
				<a></a>
			</div>
		<(/if)>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-notice">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-notice" style="background: <(style.background)>; padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px;">
			<div class="diy-notice-container <(if style.paddingleft != 0)> border-1px-l border-1px-r <(/if)> <(if style.paddingtop != 0)> border-1px-t border-1px-b <(/if)>">
				<div class="image border-1px-r">
					<img src="<(tomedia params.imgurl)>" alt="">
				</div>
				<div class="icon">
					<i class='icon icon-notification' style="color: <(style.iconcolor)>"></i>
				</div>
				<div class="notice-text" style="color: <(style.textcolor)>">
					<ul>
						<(if params.noticedata == 0)>
							<li>这里将读取商城里的公告进行滚动</li>
						<(else)>
							<(each data as item)>
								<li>
									<a href="javascript:;" style="color: <(style.textcolor)>">
										<(item.title)>
									</a>
								</li>
							<(/each)>
						<(/if)>
					</ul>
				</div>
			</div>
		</div>
	</div>
</script>

<script type="text/html" id="tpl-show-graphic">
	<div class="drag" data-itemid="<(itemid)>">
		<div class="diy-graphic" style="background: <(style.background)>; padding-top: <(style.paddingtop)>px; padding-bottom: <(style.paddingtop)>px; padding-left: <(style.paddingleft)>px; padding-right: <(style.paddingleft)>px;">
			<div class="diy-graphic-container clearfix">
				<(each data as item)>
					<a href="javascript:;" class="diy-graphic-list" style="background: <(style.cardbackground)>">
						<div class="main-title" style="color: <(style.titlecolor)>"><(item.title)></div>
						<div class="subhead" style="color: <(style.subheadcolor)>"><(item.subhead)></div>
						<div class="img">
							<img src="<(tomedia item.imgurl)>" alt="">
						</div>
					</a>
				<(/each)>
			</div>
		</div>
	</div>
</script>