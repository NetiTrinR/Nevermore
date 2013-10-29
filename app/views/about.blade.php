@extends('layouts.default')
@section('content')
<!-- New bio text -->
<!-- This admin has yet to submit a Bio to Rails.  This is bad and they should feel bad. -->
<div class="row">
	<div class="panel panel-default" id="serverinfo">
		<div class="panel-heading">
			<h1 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#serverinfo" href="#serverinfo-body">Server Infos</a></h1>
		</div>
		<div class="panel-collapse collapse out" id="serverinfo-body">
			<div class="panel-body">Stuffs to go here</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default" id="serverlore">
		<div class="panel-heading">
			<h1 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#serverlore" href="#serverlore-body">Lore</a></h1>
		</div>
		<div class="panel-collapse collapse out" id="serverlore-body">
			<div class="panel-body">Stuffs to go here</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default" id="webinfo">
		<div class="panel-heading">
			<h1 class="panel-title"><a class="accordion-toggle" data-toggle="collapse" data-parent="#webinfo" href="#webinfo-body">Website Infos</a></h1>
		</div>
		<div class="panel-collapse collapse out" id="webinfo-body">
			<div class="panel-body">
				<p>
					You are currently viewing <a href="#" class="tooltips text-muted" data-toggle="tooltip" title="month xx, 2013">v1.0.0&alpha;</a>.
				</p>
				<p>
					This website is the product of several hours of solo development by <a href="{{ URL::to('/user/rails/profile') }}">Railalis</a>.<br />
					It impliments the <a href="http://laravel.com/" class="text-info">Laravel 4.0 Framework</a>, <a href="http://getbootstrap.com" class="text-info">Bootstrap 3.0 Framework</a>, <a href="http://daringfireball.net/projects/markdown/" class="text-info">Markdown Markup</a> and several plugins.
				</p>
				<p>
					Forums on Nevermore use a tag based sorting system instead of traditional topic boards. All postable text within Nevermore impliments the same reply model which is used by a textless <a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Bet you didn't know that!">thread model</a>.
				</p>
				<p>
					The design and overall style was initially borrowed heavly from <a href="http://thecolorless.net" class="tooltips text-info" data-toggle="tooltip" title="A forum board and chat site which Rails is an active member of">The Colorless</a>.<br />
					We hope to evolve into our own niche based upon feedback from you, the users.
				</p>
				<p><b>Released month xxth, 2013</b></p>
				<p>
					<b>Plguins:</b>
					<ul>
						<li>Plugins list 1</li>
						<li>Plugins list 2</li>
					</ul>
				</p>
			</div>
		</div>
	</div>
</div>
<h1>Server Staff</h1>
<div class="row">
	<div class="well">
		<center><img src="http://www.ledr.com/colours/white.jpg" alt="group" class="img-rounded" width="650" height="300"></center>
	</div>
</div>
<h3>Server Admins</h3>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Crazy1j - The Insane One</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/crazy1j/profile') }}"><img src="" alt="crazy1j" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">
					<p>Hello my fellow builders, miners, engineers, and Architectural junkies this your hero Crazy1j.</p>
					<p>I am currently a part of Caffinated Addicts and reside in the Nevermore server creating fantastic and mind blowing structures. I love exsplosives and weapons of mass destruction. If you ever have a building idea that is new, unique, or just over the top enormous hit me up.</p>
					<p>IRL I am college student majoring in Agricultural Education and a fledging DJ. I will hopefully be a full time teacher by 2016 if and only if I can get get a suitable class schedule hammered out to get me there in that amount of time.</p>
					<p>Yes, I am crazy.</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Jodilynn - Propaganda Manager</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/jodilynn/profile') }}"><img src="{{ URL::to('/img/about-us/staff_jodilynn.jpg') }}" alt="jodilynn" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">
					<p>Hiya! Jodilynn here. I am the advertiser for the Nevermore Sever. Should you have questions for any of us, please contact the server twitter or facebook and I'll get back to you in a timely manner. </p>
					<p>In game, I am known for my fantastic naming skills and my decorating. Though I mostly play Minecraft, I also enjoy classic games from the 90's and Sims. I intend to expand my gaming experience so if you have any (free) recommendations for me, hit up the social media! 
					</p>
					<p>IRL, I am a substitute pre-school teacher who is trying to get in full time somewhere. On October 24th of 2012, I went to the hospital with a pretty serious infection and I'm so thankful to be here today after eight weeks in ICU. I just recently got into <a href="http://www.youtube.com/user/jodilynnplays" class="text-info">video editing</a> and I'm enjoying every second of it.</p>
					<p>I love to chat so send me a message or ask for my skype if you want to get to know me better! Hope to speak with all of you soon! <span class="glyphicon glyphicon-thumbs-up"></span>
					</p>
					<ul class="list-inline">
						<li><a href="https://twitter.com/jodilynn04">@jodilynn04</a></li>
						<li><a href="http://www.youtube.com/user/jodilynnplays">jodilynnplays</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Maximum - Maximum Security</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/max/profile') }}"><img src="{{ URL::to('/img/about-us/staff_max.png') }}" alt="max" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">
					<p><span class="glyphicon glyphicon-hand-right"></span> im just awesome <span class="glyphicon glyphicon-heart-empty"></span> <abbr title="for random reasons"><span class="glyphicon glyphicon-leaf"></span></abbr></p>
					<p><small>And likes icons. ~Rails</small></p>
					<ul class="list-inline">
						<li><a href="https://twitter.com/Caffeinated_Max">@Caffeinated_Max</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Railalis - Web Admin</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/rails/profile') }}"><img src="{{ URL::to('/img/about-us/staff_railalis.png') }}" alt="railalis" class="img-rounded"></a></center>
					<!-- <br /><small>Now taking skin suggestions!</small> -->
				</div>
				<div class="col-lg-10">
					<p>Howdy!  I am Railalis, the <a href="#" class="tooltips text-muted" data-toggle="tooltip" title="Slightly egotistical">creator and admin</a> of the Nevermore Server website. Should you encounter any errors with it, <a href="mailto:netitrinr@gmail.com" class="text-warning">let me know</a>.</p>
					<p>In game I am known for my <a href="#" class="tooltips text-muted" data-toggle="tooltip" title="I don't think I am very good at it personally">redstone</a> and being an all around builder.  I am the 'worst' Admin on Nevermore as I know very little of the inner workings of our server and I abuse my powers all too often.  Aside from minecraft I like to play Retro and Indie games.  I also enjoy League of Legends and a select few MMORPGs.</p>
					<p>IRL, I am a computer science major at Montana State University for which I also work as a professional web developer.  I enjoy computers obviously, Japanese Culture, and some outside activities which include but aren't limited to snowboarding, sailing, Aikido, Kendo, curling, and east coast swing dance.</p>
					<p>Message me in game if you would like to hang out or get to know me better.</p>
					<ul class="list-inline">
						<li><a href="https://twitter.com/Railalis">@Railalis</a></li>
						<li><a class="tooltips" data-toggle="tooltip" href="https://github.com/NetiTrinR" title="I don't use this much since most of my work is confidential">GitHub</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Shotsfired - The Watch Dog</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/shots/profile') }}"><img src="{{ URL::to('/img/about-us/staff_shots.png') }}" alt="jodilynn" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">This admin has yet to submit a Bio to Rails.  This is bad and they should feel bad.</div>
			</div>
		</div>
	</div>
</div>
<h3>Server Moderators</h3>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Ailleric - The <strike>Littlest</strike> Dragon</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/ailleric/profile') }}"><img src="" alt="ailleric" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">
					<p>
						Hello everyone, I'm Ailleric or Aill for short. Well here is my little bio. I'm a proud to be moderator on Nevermore. I am the leader and creator of the minecraft group The Guardians. I'm also part of a bigger group on the server called Caffeinated Addicts. I try to be as nice as possible and help anyone as much as I can. If there is ever a fight or a problem, I will try to resolve it the best I can. You can't really get on my bad side unless you start disrespecting people, that's just what puts you over. And if you break rules.. Anything else then you're still on my good side. I own the town Azalea on the server, which is fairly big. I'm the giant tree builder on the server and somewhat of a good designer. I'm also the dragon on the server. Well that's a bit of info on me. Hope to see you on the server, have a nice day!
					</p>
					<ul class="list-inline">
						<li><a href="https://twitter.com/Ailleric_MC">@Ailleric_MC</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Forseti - The Wisened Vigil / He Runs Oasis</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/forseti/profile') }}"><img src="{{ URL::to('/img/about-us/staff_forseti.png') }}" alt="forseti" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">
					<p>Heya! Forseti is the name, Minecraft is the game ;-)</p>
					<p>In game:  I am known for creating the town of Oasis, on nearly every server I’ve been on.  I’ve been playing Minecraft for about 2.5 years now.  I play several other games occasionally, but MC keeps my attention most of the time.</p>
 					<p>IRL:  I am a contractor for the Government doing video conferencing.  What I like to do while playing Minecraft: watch a lot of TV, and when away from computer I go to a lot of movies.</p>
 					<p>Message me in game if there is an issue that needs to be investigated or repaired.  As for social media, I have Twitter but don’t have it on my cellphone, so usually quicker to leave in-game mail.</p> 
					<ul class="list-inline">
						<li><a href="https://twitter.com/Forseti333">@Forseti333</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">Frosty - The Master of Shadows</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href="{{ URL::to('/user/frosty/profile') }}"><img src="{{ URL::to('/img/about-us/staff_frosty2.png') }}" alt="frosty" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">
					<p>Old enough to know better, young enough not to care; Im not too much of a stickler for the rules, but I do try to stick to them, if they can be bent to just help out a little, then so be it.</p>
					<p>Been an avid gamer, and have won multiple prizes in little tournaments that are hosted by local gaming stores, however now I play for the fun of others, and to help other players find out what game style is a bad game style for them. I am a thinker when I play, and a very tactical player, however I can be very distracted by outside sources. Love my simulation games as well, and plan to do a series about ALL the simulation games I own for all the lovly people to see and to see the thought process about playing them.</p>
					<p>My hobbies include in custom computer builds, from full water cooling too mini-itx builds; video editing; 3d modeling and even a spot of photography using a number of camera's.</p>
					<p>Well to sum it all up, Its a game-eat-game world out there, and we each much find our own toppings, so "lets game"</p>
				</div>
			</div>
		</div>
	</div>
</div>
<h3>Server Builders</h3>
<div class="row">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h1 class="panel-title">404!</h1>
		</div>
		<div class="panel-body">
			<div class="row">
				<div class="col-lg-2"><center><a href=""><img src="" alt="" class="img-rounded" width="100px" height="170px"></a></center></div>
				<div class="col-lg-10">We currently have no Builders at this time.  See announcements for details on becoming one.</div>
			</div>
		</div>
	</div>
</div>
@endsection