{**
 * plugins/blocks/journalInfo/block.tpl
 * Jean
 *}
<div class="pkp_block block_journalInfo">
	<span class="title" style="width: 100%">{translate key="plugins.block.journalInfo.link"}</span>
	<div class="content">
		{if $journalThumbnailPath}
			<img src="{$baseUrl}/{$journalThumbnailPath}" />
		{/if}
	</div>
</div>
