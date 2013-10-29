@extends('layouts.default')
@section('content')
	<div class="row">
		<div id="server" class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Server Rules</h1>
			</div>
			<div class="panel-body">
				<ol>
					<li>
						<b>Overall Rules</b><br />
						<ol type='a' start='1'>
							<li>Be respectful of others.</li>
							<li>No excessive cussing. If you have to drop 3 f bombs in one sentence that's a bit much.</li>
							<li>Respect Server Staff.</li>
							<li>No setting homes in other player's area's UNLESS you have their permission.</li>
							<li>Use Common Sense.</li>
							<li>No Spamming.</li>
							<li>No advertising other server's.</li>
							<li>No links to inappropriate content. Unless they are really good and you are sending them to me (Shotsfired).</li>
							<li>No using client-side mods like x-ray or nodus to cheat.</li>
							<li>No using magic carpet to get inside someone's build.</li>
							<li>Ignorance is not an excuse, if you did not read the rules it's still your fault.</li>
						</ol>
					</li>
					<br />
					<li>
						<b>World 1 rules</b> (world to be named later)<br />
						<ol type='a' start='1'>
							<li>No Griefing. This includes unprotected builds in the wilderness as well. This world is for building.</li>
							<li>No unwanted pvp in the wilderness areas. There will be designated pvp area's like arena's you can go to for this as well as an entire world dedicated to factions style pvp. (You may pvp to defend yourself)</li>
						</ol>
					</li>
					<br />
					<li>
						<b>World 2 Battlefield rules</b><br />
						<ol type='a' start='1'>
							<li>No griefing within someone's fort. However you may place ladders, levers and buttons.</li>
							<li>No using magic carpet to get inside someone's build.</li>
						</ol>
					</li>
				</ol>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="web" class="panel panel-default">
			<div class="panel-heading">
				<h1 class="panel-title">Website Rules</h1>
			</div>
			<div class="panel-body">
				<ol>
					<li>
						<b>
							Act without limiting the fun or disrupting the discussions of other people.
						</b>
						<br />
						Keep up the positive feedback loop!
					</li>
					<li>
						<b>
							Do not do or promote anything illegal on the site.
						</b>
						<br />
						If in doubt, refer to US law.
					</li>
					<li>
						<b>
							Do not misrepresent yourself or miscredit content.
						</b>
						<br />
						Don't claim to be someone you're not, don't take credit for others' creations.
					</li>
					<li>
						<b>
							Do not spam messages.
						</b>
						<br />
						Repeated messages, unsolicited and irrelevant links and flows of gibberish are considered spam.
					</li>
					<li>
						<b>
							Do not repost material deleted by the staff without permission.
						</b>
						<br />
						The staff had a reason to delete it.
					</li>
					<li>
						<b>
							Do not make threads about technical support issues.
						</b>
						<br />
						Contact a moderator or administrator, or use the bug report system.
					</li>
					<li>
						<b>
							Do not use alternative accounts to like posts, report posts, or vote in polls multiple times.
						</b>
						<br />
						That's cheating.
					</li>
					<li>
						<b>
							Do not post anything 18+.
						</b>
						<br />
						This is a minecraft server website, this is not the place for that.
					</li>
				</ol>
			</div>
		</div>
	</div>
	<div class="row">
		<div  id="add" class="panel panel-default">
			<div class="panel-heading">
					<h1 class="panel-title">Additional Rules</h1>
				</div>
				<div class="panel-body">
					<p>
						<b>When in doubt, ask. If you think something may be rule breaking, do not do it. Instead, speak with a moderator and clear things up before posting. We don't bite!</b>
					</p>
					<p>
						Anything not expressly forbidden in these rules yet still found to be misconduct by the staff will be taken into consideration on a case-by-case basis.
						<b>
							Note that the terms of service reserve us a right to ban a user at any time, for any reason.
						</b>
					</p>
					<p>
						<b>All rules are as interpreted by the staff.</b> Evidently unintentional rule violations may result in a warning before revocation of privileges.
					</p>
					<p>
						As noted in the <a href="{{ URL::Route('terms')}}">terms of service</a> it is site policy to comply with all law enforcement organizations.
					</p>
				</div>
		</div>
	</div>
@endsection