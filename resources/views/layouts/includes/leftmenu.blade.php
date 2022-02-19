                    <div class="col-xl-2 col-lg-3 d-none d-lg-block">
                        <div class="dashboard-sidebar">
                            <div class="dashboard-menu">
                                <ul class="nav">
                                    <li>
                                        <h3>依頼者</h3>
                                        <ul>
                                            <li><a href="{{ url('/irai') }}"><i class="lnr lnr-chart-bars"></i> 依頼する </a></li>
                                            <li><a href="{{ url('/irai_ichiran') }}"><i class="lnr lnr-bubble"></i> 依頼履歴 </a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h3>翻訳者</h3>
                                        <ul>
                                            <li><a href="{{ url('/search_job') }}"><i class="lnr lnr-briefcase"></i> 仕事検索 </a></li>
                                            <li><a href="{{ url('/favorite_list') }}"><i class="lnr lnr-briefcase"></i> お気に入り </a></li>
                                            <li><a href="{{ url('/shigoto_ichiran') }}"><i class="lnr lnr-bookmark"></i> 受託一覧</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <h3>アカウント情報</h3>
                                        <ul>
                                            <li><a class="active" href="{{ url('/mypage') }}"><i class="lnr lnr-user"></i> マイページ</a></li>
                                            <li><a href="{{ url('/charge') }}"><i class="lnr lnr-cart"></i> チャージする </a></li>
                                            <li>
                                                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="lnr lnr-exit-up"></i> ログアウト 

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>

                                                </a>
                                            </li>

                                        </ul>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>