@extends('layouts.master')
    @section('content') 
        @include('include.search') 
        <!--content start-->
        <div class="content-box">
             <div class="container">
    <div class="row">
        
      <div class="col-sm-12">
        
        <h1 class="page-title">Make Payment</h1>
        
        <div class="contant-box">
            <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">
              <div class="panel panel-default">
                <div id="headingOne" role="tab" class="panel-heading">
                  <h4 class="panel-title">
                    <a aria-controls="Need" aria-expanded="true" href="#Need" data-parent="#accordion" data-toggle="collapse" role="button" class="">
                      Need to reach out to us? Here's how. <span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>
                    </a>
                  </h4>
                </div>
                <div aria-labelledby="headingOne" role="tabpanel" class="panel-collapse collapse in" id="Need" aria-expanded="true" style="">
                  <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4 contact-detail-box">
                                <h2 class="contact-detail-title">Quebec</h2>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </p>
                                <p><a href="#">Show on a map</a></p>
                                <p><strong>Toll free:</strong> 1 (866) 387-7677<br> <strong>Fax:</strong> 1 (866) 832-2066 </p>
                            </div>
                            <div class="col-sm-4 contact-detail-box">
                                <h2 class="contact-detail-title">Montreal</h2>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </p>
                                <p><a href="#">Show on a map</a></p>
                                <p><strong>Toll free:</strong> 1 (866) 387-7677<br> <strong>Fax:</strong> 1 (866) 832-2066 </p>
                            </div>
                            <div class="col-sm-4 contact-detail-box">
                                <h2 class="contact-detail-title">Customer service</h2>
                                <p>
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                </p>
                                <p><a href="#">Show on a map</a></p>
                                <p><strong>Toll free:</strong> 1 (866) 387-7677<br> <strong>Fax:</strong> 1 (866) 832-2066 </p>
                            </div>
                        </div>    
                                        
                        <div class="follow-box">
                            <h2 class="contact-detail-title">Follow us</h2>
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-skype"></i></a></li>
                            </ul>
                        </div>
                        
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div id="headingTwo" role="tab" class="panel-heading">
                  <h4 class="panel-title">
                    <a aria-controls="departments" aria-expanded="false" href="#departments" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                      To reach one of our departments <span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>
                    </a>
                  </h4>
                </div>
                <div aria-labelledby="headingTwo" role="tabpanel" class="panel-collapse collapse" id="departments" aria-expanded="false" style="height: 2px;">
                  <div class="panel-body">
                        <form>
                        <div class="row contact-field">
                          <div class="form-group clear">
                          <div class="col-sm-5">
                            <label>Department</label>
                            <div class="selelct-box">
                                <select class="form-control">
                                    <option>Choose department</option>
                                    <option>Public relations</option>
                                    <option>Legal affairs</option>
                                    <option>Marketing</option>
                                    <option>Human resources</option>
                                    <option>Technical support</option>
                                </select>
                            </div>
                          </div>
                          </div>
                          
                          <div class="form-group clear">
                              <div class="col-sm-5">
                                <label>Phone</label>
                                <input type="text" class="form-control">
                              </div>
                          </div>
                          
                          <div class="form-group clear">
                              <div class="col-sm-5">
                                <label>Email *</label>
                                <input type="email" class="form-control">
                              </div>
                          </div>
                          
                          <div class="form-group clear">
                              <div class="col-sm-10">
                                <label>Your message <span class="">*</span></label>
                                <textarea class="form-control"></textarea>
                              </div>
                          </div>
                          
                          <div class="col-sm-5">
                            <button class="submit-button" type="submit">Send</button>
                          </div>
                            
                        </div>
                        </form>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div id="headingThree" role="tab" class="panel-heading">
                  <h4 class="panel-title">
                    <a aria-controls="representatives" aria-expanded="false" href="#representatives" data-parent="#accordion" data-toggle="collapse" role="button" class="collapsed">
                      Our representatives <span><i class="fa fa-angle-down"></i><i class="fa fa-angle-up"></i></span>
                    </a>
                  </h4>
                </div>
                <div aria-labelledby="headingThree" role="tabpanel" class="panel-collapse collapse" id="representatives" aria-expanded="false" style="height: 2px;">
                  <div class="panel-body">
                  </div>
                </div>
              </div>
            </div>
        </div>
        
      </div>
      
    </div>    
    </div>
        </div>
        <!--content end--> 
@stop