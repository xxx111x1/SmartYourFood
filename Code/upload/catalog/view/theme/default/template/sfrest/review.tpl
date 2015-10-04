<script src="catalog/view/javascript/review.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="catalog/view/theme/default/stylesheet/review.css">
<div class="review-dialog-frame  unvisible">
	<input id="rest-id" type="hidden" value="<?php echo $rest_id; ?>">
	<div class="review-dialog-wrap">
		<div class="review-header">
			<div class="review-title">发表评论</div>
			<div class="review-close"></div>
		</div>
		<div class="review-scores">
			<div class="review-score">
				<input type="hidden" id="all-score" value="4" />
				<div class="score-label">总体评分:</div>
				<div class="score-value">
					<div class="score1" rate="1"></div>
					<div class="score2" rate="2"></div>
					<div class="score3" rate="3"></div>
					<div class="score4" rate="4"></div>
					<div class="score5" rate="5"></div>
				</div>
			</div>
			<div class="review-score">
				<input type="hidden" id="taste-score" value="4" />
				<div class="score-label">口味:</div>
				<div class="score-value">
					<div class="score1" rate="1"></div>
					<div class="score2" rate="2"></div>
					<div class="score3" rate="3"></div>
					<div class="score4" rate="4"></div>
					<div class="score5" rate="5"></div>
				</div>
			</div>
			<div class="review-score">
				<input type="hidden" id="service-score" value="4" />
				<div class="score-label">服务:</div>
				<div class="score-value">
					<div class="score1" rate="1"></div>
					<div class="score2" rate="2"></div>
					<div class="score3" rate="3"></div>
					<div class="score4" rate="4"></div>
					<div class="score5" rate="5"></div>
				</div>
			</div>
		</div>
		<div class="review-comment">
			<textarea id="comment" placeholder="Hi,好吃吗？快来分享您的心得吧~" ></textarea>
		</div>
		<div id="send-review">发表评论</div>
	</div>
</div>