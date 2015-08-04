<?php
namespace tests\Actions\UpdateDraft;

use moosend\Actions\UpdateDraft\UpdateDraftRequest;
use moosend\Models\Campaign;
use moosend\StubCampaign;
use moosend\Models\Sender;
use moosend\Models\MailingList;
use moosend\Models\Segment;
use moosend\Models\ABCampaignData;

class UpdateDraftRequestTest extends  \PHPUnit_Framework_TestCase {
	/**
	 * Test UpdateDraftRequest constructor when all properties are set.
	 * @group UpdateDraftRequestTest
	 * @covers moosend\Actions\UpdateDraft\UpdateDraftRequest::__construct
	 */
	public function test_Can_Create_UpdateDraftRequest_Instance() {
		$campaign = Campaign::withJSON(json_decode(file_get_contents(__DIR__ . '/../../JsonResponses/getCampaignRawJsonResponse.html'), true)['Context']);			
		
		$updateDraftRequest = new UpdateDraftRequest($campaign);
		
		$this->assertInstanceOf('moosend\Actions\UpdateDraft\UpdateDraftRequest', $updateDraftRequest);
		
		$this->assertEquals($campaign->getName(), $updateDraftRequest->Name);
		$this->assertEquals($campaign->getSubject(), $updateDraftRequest->Subject);
		$this->assertEquals($campaign->getWebLocation(), $updateDraftRequest->WebLocation);
		$this->assertEquals($campaign->getConfirmationTo(), $updateDraftRequest->ConfirmationToEmail);
		
		$this->assertEquals($campaign->getSender()->getEmail(), $updateDraftRequest->SenderEmail);
		$this->assertEquals($campaign->getReplyToEmail()->getEmail(), $updateDraftRequest->ReplyToEmail);
		$this->assertEquals($campaign->getMailingList()->getID(), $updateDraftRequest->MailingListID);
		$this->assertEquals($campaign->getSegment()->getID(), $updateDraftRequest->SegmentID);
		
		$this->assertEquals($campaign->getABCampaignData()->getABCampaignType(), $updateDraftRequest->ABCampaignType);
		$this->assertEquals($campaign->getABCampaignData()->getABWinnerSelectionType(), $updateDraftRequest->ABWinnerSelectionType);
		$this->assertEquals($campaign->getABCampaignData()->getHoursToTest(), $updateDraftRequest->HoursToTest);
		$this->assertEquals($campaign->getABCampaignData()->getListPercentage(), $updateDraftRequest->ListPercentage);
		$this->assertEquals($campaign->getABCampaignData()->getSubjectB(), $updateDraftRequest->SubjectB);
		$this->assertEquals($campaign->getABCampaignData()->getWebLocationB(), $updateDraftRequest->WebLocationB);
		
		$this->assertEquals($campaign->getABCampaignData()->getSenderB()->getEmail(), $updateDraftRequest->SenderEmailB);
		
	}
	
	/**
	 * Test UpdateDraftRequest constructor when Sender, ReplyToEmail, MailingList, Segment, getABCampaignData are null.
	 * @group UpdateDraftRequestTest
	 * @covers moosend\Actions\UpdateDraft\UpdateDraftRequest::__construct
	 */
	public function test_Can_Create_UpdateDraftRequest_Instance_When_Properties_Are_Null() {
		$campaign = new Campaign();
		$ABCampaignData = new ABCampaignData();
		$campaign->setABCampaignData($ABCampaignData);
		$updateDraftRequest = new UpdateDraftRequest($campaign);
	
		$this->assertInstanceOf('moosend\Actions\UpdateDraft\UpdateDraftRequest', $updateDraftRequest);
	
		$this->assertEquals($campaign->getName(), $updateDraftRequest->Name);
		$this->assertEquals($campaign->getSubject(), $updateDraftRequest->Subject);
		$this->assertEquals($campaign->getWebLocation(), $updateDraftRequest->WebLocation);
		$this->assertEquals($campaign->getConfirmationTo(), $updateDraftRequest->ConfirmationToEmail);
	
		$this->assertEquals(null, $updateDraftRequest->SenderEmail);
		$this->assertEquals(null, $updateDraftRequest->ReplyToEmail);
		$this->assertEquals(null, $updateDraftRequest->MailingListID);
		$this->assertEquals(null, $updateDraftRequest->SegmentID);
	
		$this->assertEquals(null, $updateDraftRequest->ABCampaignType);
		$this->assertEquals(null, $updateDraftRequest->ABWinnerSelectionType);
		$this->assertEquals(null, $updateDraftRequest->HoursToTest);
		$this->assertEquals(null, $updateDraftRequest->ListPercentage);
		$this->assertEquals(null, $updateDraftRequest->SubjectB);
		$this->assertEquals(null, $updateDraftRequest->WebLocationB);
	
		$this->assertEquals(null, $updateDraftRequest->SenderEmailB);
	}
}