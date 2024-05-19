<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use App\Models\Company;

class ListingOfferAcceptedMail extends Mailable
{
    use Queueable, SerializesModels;

    public Listing $listing;
    public Offer $offer;
    public User $user;
    public Company $company;

    /**
     * Create a new message instance.
     */
    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
        $this->listing = $offer->listing;
        $this->user = $this->listing->user;
        $this->company = $this->user->company;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ponuda Prihvaćena',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.listing_offer_accepted',
            with: [
                'offer' => $this->offer,
                'listing' => $this->listing,
                'user' => $this->user,
                'company' => $this->company,
            ],
        );
    }


    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
