@extends('main')
@section('title','| Contact')
@section('content')
        <div class="row">
            <div class="col-md12">
                <h1>Contact Us</h1>
                <hr>
                <form action="{{ url('contact')}}" method="POST">
                    {{csrf_field() }}
                    <div class="form-group">
                        <label name="email">Email</label>
                        <input name="email" id="email" class="form-control">
                    </div>

                     <div class="form-group">
                        <label name="subject">Subject</label>
                        <input name="subject" id="subject" class="form-control">
                    </div>

                    <div class="form-group">
                        <label name="message">Message</label>
                        <textarea id="message" name="message" class="form-control"></textarea>
                    </div>

                    <input type="submit" name="Send Message" class="btn btn-success">
                </form>
            </div>
        </div>
        
 
 @endsection

